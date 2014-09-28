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
        $pageName = Input::get('pageName');

        return View::make("home/$pageName");
    }
}
