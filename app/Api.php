<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
	protected $fillable = ['user_id','status','consumerkey','consumersecret'];

	public function done($status){
		return $this->fill(['status' => $status])->save();;
	}
}