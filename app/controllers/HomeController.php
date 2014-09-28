<?php

/**
 *
 * @author 谢浩哲 <zjhzxhz@gmail.com>
 */
class HomeController extends BaseController {
    /**
     * 加载用户登陆页面.
     * @return 包含登陆页面的View对象
     */
    public function index() {
        return View::make('home/index');
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
