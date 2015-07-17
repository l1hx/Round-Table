<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model 
    implements AuthenticatableContract, CanResetPasswordContract {
    use Authenticatable, CanResetPassword;

    public function classmate() {
        return $this->hasOne('App\Models\Classmate', 'username');
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
    protected $guarded = array('username', 'password', 'email');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
}

