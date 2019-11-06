<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     protected $fillable = [
    	'name', 'email', 'mobile', 'company', 'profile'
    ];
    protected $table = 'employee';
}
