<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Seller extends Authenticatable

{
    use HasFactory;

    protected $fillable=['full_name','user_name','email','email_verified_at','password','photo','phone','status','is_verified'];
}
