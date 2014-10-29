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
    protected $guarded = array('activity_id', 'activity_name', 'create_time', 'sponsor', 'start_time', 'end_time', 'place', 'detail');

    /**
     * The field needs to be filled when ::create() method is invoked.
     * 
     * @var array
     */
    protected $fillable = array('activity_name', 'sponsor', 'start_time', 'end_time', 'place', 'detail');

    /**
     * Disabled the `update_at` field in this table.
     * 
     * @var boolean
     */
    public $timestamps = false;
}
