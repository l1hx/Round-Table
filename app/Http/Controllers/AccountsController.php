<?php

namespace App\Http\Controllers;

use Auth; 
use Session;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

use App\Models\EmailValidation;
use App\Models\User;

/**
 * 用户账户类, 用于处理账户相关的请求.
 * @author 谢浩哲 <zjhzxhz@gmail.com>
 */
class AccountsController extends BaseController {
    /**
     * 加载用户登陆页面.
     * @return 包含登陆页面的View对象
     */
    public function login() {
        $isLoggout = Request::input('logout', false);

        if ( $isLoggout ) {
            Auth::logout();
        }
        return View::make('accounts/login')
                ->with('isLoggout', $isLoggout);
    }

    /**
     * 处理用户的登录请求.
     * @return 一个包含登录验证信息的JSON数组
     */
    public function loginAction() {
        $username = Request::input('username');
        $password = Request::input('password');

        $result = array(
            'isSuccessful'      => false, 
            'isUsernameEmpty'   => empty($username),
            'isPasswordEmpty'   => empty($password),
            'isAccoutValid'     => false,
        );

        if ( !$result['isUsernameEmpty'] && !$result['isPasswordEmpty'] ) {
            $user = User::find($username);
            if ( $user != null && $user->password == $password ) {
                $result['isAccoutValid'] = true;
                $result['isSuccessful']  = true;
                Auth::login($user);    
            }
        }
        return Response::json($result);
    }

    /**
     * 加载重置密码页面.
     * @return 包含重置密码页面的View对象
     */
    public function resetPassword() {
        $email    = Request::input('email', null);
        $keycode  = Request::input('keycode', null);

        $isConfidentialSetted = ($email != null && $keycode != null);
        $isConfidentialValid  = $this->isConfidentialValid($email, $keycode);

        return View::make('accounts/reset')
                ->with('isConfidentialSetted', $isConfidentialSetted)
                ->with('isConfidentialValid', $isConfidentialValid);
    }

    /**
     * 检查密码重置凭据是否合法.
     * @param  String $email   - 用户的电子邮件地址
     * @param  String $keycode - 重置密码的凭据
     * @return 密码重置凭据是否合法
     */
    private function isConfidentialValid($email, $keycode) {
        return (EmailValidation::whereRaw('email = ? and keycode = ?', array($email, $keycode))->get()->count());
    }

    /**
     * 处理用户重设密码的请求. 用于验证用户身份的合法性.
     * @return 一个包含验证结果的JSON数组
     */
    public function confirmConfidentialAction() {
        $username = Request::input('username', null);
        $email    = Request::input('email', null);

        $result   = array(
            'isSuccessful'          => false,
            'isUsernameEmpty'       => empty($username),
            'isEmailEmpty'          => empty($email),
            'isConfidentialValid'   => false,
        );

        if ( !$result['isUsernameEmpty'] && !$result['isEmailEmpty'] ) {
            $user = User::find($username);
            if ( $user != null && $user->email == $email ) {
                $result['isConfidentialValid']  = true;
                $result['isSuccessful']         = true;
                $this->sendResetPasswordEmail($username, $email);
            }
        }
        return Response::json($result);
    }

    /**
     * 发送重设密码的电子邮件.
     * @param  String $username - 用户名
     * @param  String $email    - 电子邮件地址
     */
    private function sendResetPasswordEmail($username, $email) {
        $keycode    = $this->generateRandomString(32);
        $this->saveConfidential($email, $keycode);

        $data       = array(
            'username'  => $username,
            'email'     => $email,
            'keycode'   => $keycode,
        );
        Mail::send('mails.reset', $data, function($message) use ($email) {
            $message->from('zsp999@qq.com', 'The Home of Class8')->subject('Reset Your Password');
            $message->to($email);
        });
    }

    /**
     * 生成随机字符串.
     * @param  int $length - 随机字符串的长度
     * @return 一个指定长度的随机字符串
     */
    private function generateRandomString($length) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     * 将密码重置凭据保存至数据库.
     * @param  String $email   - 用户的电子邮件地址
     * @param  String $keycode - 重置密码的凭据
     */
    private function saveConfidential($email, $keycode) {
        $confidential = EmailValidation::find($email);
        if ( $confidential != null ) {
            $confidential->delete();
        }

        EmailValidation::create(array(
            'email'     => $email,
            'keycode'   => $keycode,
        ));
    }

    /**
     * 处理用户重置密码的请求.
     * @return 一个包含密码重置结果的JSON数组
     */
    public function resetPasswordAction() {
        $email              = Request::input('email', null);
        $keycode            = Request::input('keycode', null);
        $newPassword        = Request::input('newPassword', null);
        $confirmPassword    = Request::input('confirmPassword', null);

        $result = array(
            'isSuccessful'      => false,
            'isPasswordEmpty'   => empty($newPassword),
            'isPasswordLegal'   => strlen($newPassword) >= 6 && strlen($newPassword) <= 16,
            'isPasswordMatched' => $newPassword == $confirmPassword,
            'isKeyCodeValid'    => $this->isConfidentialValid($email, $keycode),
        );
        $result['isSuccessful'] = !$result['isPasswordEmpty']   && $result['isPasswordLegal'] &&
                                   $result['isPasswordMatched'] && $result['isKeyCodeValid'];

        if ( $result['isSuccessful'] ) {
            $this->removeConfidential($email);
            $this->doResetPasswordAction($email, $newPassword);
        }
        return Response::json($result);
    }

    /**
     * 删除重置密码凭据.
     * 当用户重置密码后, 删除该凭据.
     * @param  String $email - 用户的电子邮件地址
     */
    private function removeConfidential($email) {
        $confidential = EmailValidation::find($email);
        if ( $confidential != null ) {
            $confidential->delete();
        }
    }

    /**
     * 处理用户重置密码的请求.
     * @param  String $email       - 用户的电子邮件地址
     * @param  String $newPassword - 新密码
     */
    private function doResetPasswordAction($email, $newPassword) {
        $user = User::where('email', '=', $email)->update(array(
            'password'  => md5($newPassword),
        ));
    }
}
