<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Account;
use App\Statistic;
use App\Followmoniter;
use App\Dmmoniter;
use App\Botmoniter;
use App\Unfollowmoniter;
use App\Replymoniter;
use Exception;
use App\Api;

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');





class DailyStatistic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailystatistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'statistic now';

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

       $screenname = $account->screenname;
       $connection = $account->twitterConnection();

       $date = date('Y-m-d');

       $s = Statistic::where('account_id',$account->account_id)->where('updated_at','like',"%$date%")->count();

       if($s == 0){

         $status = $connection->get("users/show",[
          'screen_name' => $screenname
        ]);

         Statistic::create([
          'account_id' => $account->account_id,
          'follow' => $status->friends_count,
          'unfollow' => $status->followers_count
        ]);

         Followmoniter::findOrFail($account->account_id)->fill(['count' => 0])->save();
         Dmmoniter::findOrFail($account->account_id)->fill(['count' => 0])->save();
         Botmoniter::findOrFail($account->account_id)->fill(['count' => 0])->save();
         Replymoniter::findOrFail($account->account_id)->fill(['count' => 0])->save();
         Unfollowmoniter::findOrFail($account->account_id)->fill(['count' => 0])->save();

         $api = $account->getApi();
         $api->fill(['status' => 0])->fill();
       }

     }catch (Exception $e){
       $this->postToDiscord($e->getLine(). "：".$e->getMessage());
     }
   }
 }
}
