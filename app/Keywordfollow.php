<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keywordfollow extends Model
{
	protected $fillable = ['account_id','keyword'];
	protected $primaryKey = 'keywordfollow_id';
}