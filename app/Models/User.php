<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['username', 'password', 'email', 'remember_identifier', 'remember_token'];

    protected $hidden = ['password'];

}