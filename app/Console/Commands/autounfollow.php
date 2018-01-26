<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Account;
use App\Unfollowmoniter;
use App\Unfollowrule;
use App\Follow;
use Carbon\Carbon;
use App\Api;

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');





class Autounfollow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autounfollow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'autofollow now';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
     $accounts = Account::all();
     foreach($accounts as $account){
      try{

       $connection = $account->twitterConnection();
       $ac_id = $account->account_id;

       $rule = $account->unfollowrule;
       $moniter = Unfollowmoniter::findOrFail($ac_id);
       

       if($account->ruleCheck($rule,$moniter)){

         $unfollow = Follow::where('account_id',$ac_id)->where('created_at','like',date("Y-m-d",strtotime("-".$span." day")))->orderby('created_at','asc')->first();
         
         $target_id = $unfollow->target_id;

         $account->unfollow($target_id,$moniter);

       }else{
        continue;
      }

    }catch (Exception $e){
      $this->postToDiscord($e->getLine(). "：".$e->getMessage());
    }
  }
}
}
