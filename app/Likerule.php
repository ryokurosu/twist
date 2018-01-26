<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likerule extends Model
{
	protected $fillable = ['account_id','text','allowtime'];
	protected $primaryKey = 'account_id';

}