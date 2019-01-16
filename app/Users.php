<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hospital_id', 'name', 'idcard', 'phone', 'famliy_phone', 'sex', 'age', 'password', 'eid', 'addtime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
