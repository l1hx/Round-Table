<?php

class Activity extends Eloquent {
    /**
     * 获取活动参与成员情况.
     * @return 活动参与成员情况
     */
    public function attendance() {
        return $this->belongsToMany('User', 'activity_attendance', 'activity_id','username')->withPivot('is_attend');
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The primary key of the table.
     * 
     * @var string
     */
    protected $primaryKey = 'activity_id';

    /**
     * The attributes of the model.
     * 
     * @var array
     */
    protected $guarded = array('activity_id', 'activity_name', 'create_time', 'sponsor', 'place', 'detail');
}
