<?php

class EmailValidation extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'email_validation';

    /**
     * The primary key of the table.
     * 
     * @var string
     */
    protected $primaryKey = 'email';

    /**
     * The attributes of the model.
     * 
     * @var array
     */
    protected $guarded = array('email', 'keycode');

    /**
     * Disable `updated_at` and `create_at` columns.
     */
    public $timestamps = false;
}
