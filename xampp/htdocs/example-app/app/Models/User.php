<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['user_name', 'email','password']; 

    public function createOne($params){
        // DBに保存
        $user = new User();
        $user->fill($params)->save();
    }
}
