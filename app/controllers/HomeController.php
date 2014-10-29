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

    public function getDashboard() {
        return array();
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
            'updatedAt' => $profile->updated_at,
        );
    }

    /**
     * 处理用户编辑个人资料的请求.
     * @return 一个包含若干标志位的JSON数组
     */
    public function editProfileAction() {
        $country    = strip_tags(Input::get('country'));
        $city       = strip_tags(Input::get('city'));
        $company    = strip_tags(Input::get('company'));

        $result     = array(
            'isSuccessful'      => false,
            'isCountryEmpty'    => empty($country),
            'isCountryLegal'    => mb_strlen($country, 'utf-8') <= 16,
            'isCityEmpty'       => empty($city),
            'isCityLegal'       => mb_strlen($city, 'utf-8') <= 16,
            'isCompanyEmpty'    => empty($company),
            'isCompanyLegal'    => mb_strlen($company, 'utf-8') <= 64,
        );
        $result['isSuccessful'] = !$result['isCountryEmpty'] && $result['isCountryLegal'] &&
                                  !$result['isCityEmpty']    && $result['isCityLegal'] &&
                                  !$result['isCompanyEmpty'] && $result['isCompanyLegal'];
        
        if ( $result['isSuccessful'] ) {
            $username           = Auth::user()->username;
            $profile            = Classmate::find($username);
            
            $profile->country   = $country;
            $profile->city      = $city;
            $profile->company   = $company;

            $profile->save();
        }
        return Response::json($result);
    }

    /**
     * 处理用户修改密码的请求.
     * @return 一个包含若干标志位的JSON数组
     */
    public function editPasswordAction() {
        $oldPassword        = md5(Input::get('oldPassword'));
        $newPassword        = Input::get('newPassword');
        $confirmPassword    = Input::get('confirmPassword');

        $result             = array(
            'isSuccessful'              => false,
            'isOldPasswordEmpty'        => empty($oldPassword),
            'isOldPasswordCorrect'      => true,
            'isNewPasswordEmpty'        => empty($newPassword),
            'isNewPasswordLegal'        => strlen($newPassword) >= 6 && strlen($newPassword) <= 16,
            'isConfirmPasswordMatched'  => ( $newPassword == $confirmPassword ),
        );
        $result['isSuccessful']         = !$result['isOldPasswordEmpty'] && !$result['isNewPasswordEmpty'] && 
                                           $result['isNewPasswordLegal'] &&  $result['isConfirmPasswordMatched'];

        if ( $result['isSuccessful'] ) {
            $username       = Auth::user()->username;
            $user           = User::find($username);

            if ( $user->password == $oldPassword ) {
                $user->password  = md5($newPassword);
                $user->save();
            } else {
                $result['isOldPasswordCorrect'] = false;
            }
        }
        return Response::json($result);
    }

    /**
     * 处理用户编辑联系信息的请求.
     * @return 一个包含若干标志位的JSON数组
     */
    public function editContactAction() {
        $email    = Input::get('email');
        $mobile   = Input::get('mobile');
        $qq       = Input::get('qq');

        $result   = array(
            'isSuccessful'      => false,
            'isEmailEmpty'      => empty($email),
            'isEmailLegal'      => strlen($email) <= 64 && preg_match('/^[A-Za-z0-9\._-]+@[A-Za-z0-9_-]+\.[A-Za-z0-9\._-]+$/', $email),
            'isMobileEmpty'     => empty($mobile),
            'isMobileLegal'     => preg_match('/^[+\-0-9]*[0-9]{8,12}$/', $mobile),
            'isQQEmpty'         => empty($qq),
            'isQQLegal'         => preg_match('/^[1-9][0-9]{4,11}$/', $qq),
        );
        $result['isSuccessful'] = !$result['isEmailEmpty']  && $result['isEmailLegal'] &&
                                  !$result['isMobileEmpty'] && $result['isMobileLegal'] &&
                                  !$result['isQQEmpty']     && $result['isQQLegal'];
        
        if ( $result['isSuccessful'] ) {
            $username           = Auth::user()->username;
            $user               = User::find($username);
            $user->email        = $email;
            $user->save();

            $profile            = Classmate::find($username);
            $profile->mobile    = $mobile;
            $profile->qq        = $qq;
            $profile->save();
        }
        return Response::json($result);
    }

    /**
     * 加载People页面的信息.
     * 获取所有用户的个人资料.
     * @return 一个包含所有用户个人资料的数组
     */
    public function getPeople() {
        return Classmate::with('user')->orderBy(DB::raw('CONVERT(username USING GBK)'))->get()->toArray();
    }

    public function getPhotos() {
        return array();
    }

    /**
     * 加载Activity页面的信息.
     * 获取所有活动的信息.
     * @return 一个包含所有活动信息的数组
     */
    public function getActivity() {
        $username           = Auth::user()->username;
        $upcomingActivities = Activity::where('start_time', '>', date('Y-m-d H:i:s'))->orderBy('start_time', 'ASC')->get();
        $pastActivities     = Activity::where('start_time', '<=', date('Y-m-d H:i:s'))->orderBy('start_time', 'DESC')->get();

        return array(
            'username'              => $username,
            'upcomingActivities'    => $upcomingActivities,
            'pastActivities'        => $pastActivities,
        );
    }

    /**
     * 获取某个活动的详细信息以及参加者的名单.
     * @return 某个活动的详细信息
     */
    public function getActivityAction() {
        $activityId = Input::get('activityId');
        $activity   = Activity::with('attendance')->where('activity_id', '=', $activityId)->first();

        $result     = array(
            'isSuccessful'  => $activity != null,
            'activity'      => $activity,
        );
        return Response::json($result);
    }

    /**
     * 处理用户参与活动的请求.
     * @return 一个包含若干标志位的JSON数组
     */
    public function attendActivityAction() {
        $activityId = Input::get('activityId');
        $isAttend   = Input::get('isAttend', 0);
        $username   = Auth::user()->username;
        $result     = array(
            'isSuccessful'          => true,
        );

        $activity   = Activity::find($activityId);
        $activity->attendance()->attach(
            $username, array(
                'is_attend' => $isAttend,
            )
        );
        return Response::json($result);
    }

    /**
     * 处理用户创建活动的请求.
     * @return 一个包含若干标志位的JSON数组
     */
    public function createActivityAction() {
        $activityName   = strip_tags(Input::get('activityName'));
        $sponsor        = Auth::user()->username;
        $startTime      = Input::get('startTime');
        $endTime        = Input::get('endTime');
        $place          = strip_tags(Input::get('place'));
        $detail         = strip_tags(Input::get('detail'));

        $result         = array(
            'isSuccessful'          => false,
            'isActivityNameEmpty'   => empty($activityName),
            'isActivityNameLegal'   => mb_strlen($activityName, 'utf-8') <= 32,
            'isStartTimeEmpty'      => empty($startTime),
            'isStartTimeLegal'      => strtotime(date('Y-m-d H:i:s')) < strtotime($startTime),
            'isEndTimeEmpty'        => empty($endTime),
            'isEndTimeLegal'        => strtotime($startTime) < strtotime($endTime),
            'isPlaceEmpty'          => empty($place),
            'isPlaceLegal'          => mb_strlen($place, 'utf-8') <= 128,
            'isDetailEmpty'         => empty($detail),
        );
        $result['isSuccessful']     = !$result['isActivityNameEmpty'] && $result['isActivityNameLegal'] &&
                                      !$result['isStartTimeEmpty']    && $result['isStartTimeLegal'] &&
                                      !$result['isEndTimeEmpty']      && $result['isEndTimeLegal'] &&
                                      !$result['isPlaceEmpty']        && $result['isPlaceLegal'] &&
                                      !$result['isDetailEmpty'];

        if ( $result['isSuccessful'] ) {
            Activity::create(array(
                'activity_name' => $activityName,
                'sponsor'       => $sponsor,
                'start_time'    => $startTime,
                'end_time'      => $endTime,
                'place'         => $place,
                'detail'        => $detail,
            ));
            $this->sendActivityEmails($activityName, $sponsor);
        }

        return Response::json($result);
    }

    /**
     * 发送电子邮件通知用户确认活动信息.
     * @param  String $activityName - 活动名称
     * @param  String $sponsor      - 活动发起人的姓名
     */
    private function sendActivityEmails($activityName, $sponsor) {
        $classmates = Classmate::with('user')->get()->toArray();

        foreach ( $classmates as $classmate ) {
            $email      = $classmate['user']['email'];
            $username   = $classmate['username'];
            if ( !empty($email) ) {
                $this->sendActivityEmail($username, $activityName, $sponsor, $email);
            }
        }
    }

    /**
     * 发送电子邮件通知用户确认活动信息.
     * @param  String $username     - 被通知用户的用户名
     * @param  String $activityName - 活动名称
     * @param  String $sponsor      - 活动发起人的姓名
     * @param  String $email        - 被通知用户的电子邮件地址
     */
    private function sendActivityEmail($username, $activityName, $sponsor, $email) {
        $data       = array(
            'username'      => $username,
            'activityName'  => $activityName,
            'sponsor'       => $sponsor,
        );
        Mail::queue('mails.activity', $data, function($message) use ($activityName, $email) {
            $message->from('noreply@zjhzxhz.com', 'The Home of Class8')->subject('诚邀您参加'.$activityName);
            $message->to($email);
        });
    }

    public function getVotes() {
        return array();
    }

    public function getHangouts() {
        return array();
    }
}
