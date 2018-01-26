<?php

namespace App\Console\Commands;
require "twitteroauth/autoload.php";

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Account;
use App\Follower;
use App\Thanksreply;
use App\Replymoniter;
use Carbon\Carbon;
use Exception;
use App\Api;

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');





class ThanksReplytweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thanksreplytweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'thanksreply now';

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
        $ac_id = $account->account_id;


        $thanksreply = Thanksreply::findorFail($ac_id);

        $span = $thanksreply->span;
        $moniter = Replymoniter::findOrFail($ac_id);
        $now = Carbon::now();
        $now->subMinutes($span + rand(0,ceil($span/5))); 


        if($now > $moniter->updated_at && $thanksreply->text != '' && in_array(date('G'),explode(',',$thanksreply->allowtime))){


          $follower = Follower::where('account_id',$ac_id)->where('replywait',0)->orderby('updated_at','asc')->first();

          $account->sendReply($follower,$moniter,$thanksreply->text);

        }

      }catch (Exception $e){
       $this->postToDiscord($e->getLine(). "：".$e->getMessage());
     }
   }
 }
}
