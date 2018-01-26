<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Account;
use App\Follower;
use Exception;
use App\Api;

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');





class GetFollowers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getfollower';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'getfollower now';

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

        $temp = $connection->get("followers/ids",[
         'screen_name' => $screenname,
         'stringify_ids' => true,
         'count' => 50
     ]);


        foreach($temp->ids as $v){
            Follower::create([
                'key' => $account->account_id.'_'.$v,
                'account_id' => $account->account_id,
                'target_id' => $v
            ]);
        }
        $account->done($temp);

    }catch (Exception $e){
     $this->postToDiscord($e->getLine(). "：".$e->getMessage());
 }
}
}
}
