<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{

    protected $table = "users";

    public $timestamps = true;

    protected $fillable = [
        'name', 'email', 'password','role'
    ];
}
