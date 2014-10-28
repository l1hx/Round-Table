<?php

class ActivityAttendance extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity_attendance';

    /**
     * The primary key of the table.
     * 
     * @var string
     */
    protected $primaryKey = array('activity_id', 'username');

    /**
     * The attributes of the model.
     * 
     * @var array
     */
    protected $guarded = array('activity_id', 'username', 'is_attend');

    /**
     * Disabled the `update_at` field in this table.
     * 
     * @var boolean
     */
    public $timestamps = false;
}
