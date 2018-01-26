<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botstory extends Model
{
	protected $fillable = ['id','name','count'];
	protected $primaryKey = 'botstory_id';

}