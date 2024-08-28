<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=['title','short_des','description','photo','address','phone','email','logo','facebook_url','x_url','instegram_url'];
}
