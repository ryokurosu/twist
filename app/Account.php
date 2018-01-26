<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Abraham\TwitterOAuth\TwitterOAuth;
use Exception;
use App\Api;
use App\Follow;
use Carbon\Carbon;

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');



class Account extends Model
{
	protected $fillable = ['account_id','consumerkey','consumersecret','accesstoken','accesstokensecret','screenname','password','tel','ip','status','accountlimit','accountcount'];
	protected $primaryKey = 'account_id';

	public function botsetting()
	{
		return $this->hasOne('App\Botsetting','account_id','account_id');
	}
	public function dmsetting(){
		return $this->hasOne('App\Dmsetting','account_id','account_id');
	}

	public function statis(){
		return $this->hasMany('App\Statistic','account_id')->orderBy('updated_at','desc');
	}

	public function followrule(){
		return $this->hasOne('App\Followrule','account_id');
	}
	public function unfollowrule(){
		return $this->hasOne('App\Unfollowrule','account_id');
	}

	public function thanksreply(){
		return $this->hasOne('App\Thanksreply','account_id');
	}
	public function like(){
		return $this->hasOne('App\Likerule','account_id');
	}

	public function getApi(){
		return Api::where('consumerkey',$this->consumerkey)->where('consumersecret',$this->consumersecret)->firstOrFail();
	}


	public function copyfollow(){
		return $this->hasOne('App\Copyfollow','account_id');
	}

	public function keywordfollow(){
		return $this->hasOne('App\Keywordfollow','account_id');
	}

	public function twitterConnection(){
		$connection = new TwitterOAuth($this->consumerkey, $this->consumersecret, $this->accesstoken, $this->accesstokensecret);
		return $connection;

	}

	public function getFollowAccounts(){
		$connection = $this->twitterConnection();
		$follows = $connection->get('friends/ids', array(
			'cursor' => -1,
			'screen_name' => $this->screenname
		));

		return $follows->ids;
	}

	public function follow($target,$moniter){
		
		try{


			$connection = $this->twitterConnection();
			$response = $connection->post('friendships/create', array('user_id' => $target));
			$result = $this->done($response,$moniter);
			Follow::create(['account_id' => $this->account_id,'target_id' => $target]);

			return true;

		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}

	}

	public function unfollow($target,$moniter){

		try{
			$connection = $this->twitterConnection();
			$response = $connection->post("friendships/destroy", array(
				"user_id"                 => $target
			));

			$result = $this->done($response,$moniter);
			return true;
		}catch(Exception $e){
			echo $e->getMessage();
			return false;

		}
	}

	public function done($response,$moniter){

		if(array_key_exists('errors',$response)){
			$status = $response->errors[0]->code;
		}else{
			$status = 0;
			$moniter->increments('count',1);
			sleep(rand(0,5));
		}
		$this->fill(['status' => $status])->save();

		$api = $this->getApi();
		$api->done($status);

		return $status;

	}

	public function sendReply($follower,$moniter,$text){
		try{

			$targetuser = $connection->get('users/show',[
				'user_id' => $follower->target_id
			]);

			$response = $connection->post('statuses/update',[
				'status' => '@'.$targetuser->screen_name."\n".$text
			]);

			$result->done($response,$moniter);
			$follower->fill(['replywait' => 1])->save();

			return true;

		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}


	}

	public function sendDM($follower,$moniter,$story){
		try{
			$connection = $this->twitterConnection();
			$response = $connection->post("direct_messages/new",[
				'user_id' => $follower->target_id,
				'text' => $story[rand(0,count($story)-1)]->text
			]);

			$result = $this->done($response,$moniter);
			$follower->fill(['dmwait' => 1])->save();

			return true;

		}catch(Exception $e){
			echo $e->getMessage();
			return false;

		}
	}

    /*
	true or false
	 */
	public function ruleCheck($rule,$moniter,$follower = null){

		$span = $rule->span;
		$limit = $rule->limit;
		$allowtime = explode(',',$rule->allowtime);

		$now = Carbon::now();
		$now->subMinutes($span + rand(0,ceil($span/5))); 

		if(is_null($response)){

			return $now > $moniter->updated_at &&
			$limit > $moniter->count &&
			in_array(date('G'),$allowtime);
		}else{

			$response = Carbon::now();
			$response->subMinutes($rule->response * 60); 

			return $now > $moniter->updated_at &&
			$limit > $moniter->count &&
			in_array(date('G'),$allowtime) &&
			$response > $follower->updated_at;

		}
	}


}