<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classmate extends Model {
    public function user() {
        return $this->belongsTo('App\Models\User', 'username');
    }

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
    protected $guarded = array('username', 'birthday', 'country', 'city', 'company', 'mobile', 'qq', 'updated_at');
}
