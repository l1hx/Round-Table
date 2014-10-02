<?php

/**
 *
 * @author 谢浩哲 <zjhzxhz@gmail.com>
 */
class HomeController extends BaseController {
    /**
     * 构造函数.
     * 用于拦截未登录的用户.
     */
    public function __construct() {
        $this->beforeFilter(function() {
            if ( !Auth::check() ) {
                return Redirect::to('accounts/login');
            } else {
                // $this->profile = $this->getProfile();
            }
        });
    }

    /**
     * 加载用户登陆页面.
     * @return 包含登陆页面的View对象
     */
    public function index() {
        return View::make('home/index')
                ->with('username', Auth::user()->username)
                ->with('email', Auth::user()->email);
    }

    /**
     * 获取子页面的内容.
     * @return 一个包含子页面内容的View对象
     */
    public function getPageContentAction() {
        $pageName       = Input::get('pageName');
        $getFunction    = 'get'.ucfirst($pageName);

        return View::make("home/$pageName")
                ->with($pageName, $this->$getFunction());
    }

    /**
     * 加载Profile页面的信息.
     * 获取用户的个人资料. 
     * @return 一个包含用户个人资料的数组.
     */
    public function getProfile() {
        $username = Auth::user()->username;
        $profile  = Classmate::find($username);

        return array(
            'username'  => $username,
            'email'     => Auth::user()->email,
            'birthday'  => $profile->birthday,
            'country'   => $profile->country,
            'city'      => $profile->city,
            'mobile'    => $profile->mobile,
            'company'   => $profile->company,
            'mobile'    => $profile->mobile,
            'qq'        => $profile->qq,
        );
    }
}
