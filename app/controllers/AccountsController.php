<?php

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
        $isLoggout = Input::get('logout', false);

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
        $username = Input::get('username');
        $password = Input::get('password');

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
}
