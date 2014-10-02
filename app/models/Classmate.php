<?php

class Classmate extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classmates';

    /**
     * The primary key of the table.
     * 
     * @var string
     */
    protected $primaryKey = 'username';

    /**
     * The attributes of the model.
     * 
     * @var array
     */
    protected $guarded = array('username', 'birthday', 'country', 'city', 'mobile', 'qq');
}
