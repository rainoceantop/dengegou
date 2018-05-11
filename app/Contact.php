<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
    	'name', 'organization', 'address',
    	'number', 'email', 'content'
    ];
    public $timestamps = false;
}
