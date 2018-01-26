<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Account;
use App\Copyfollow;
use App\Keywordfollow;
use App\Followrule;
use App\Follow;
use App\Followmoniter;
use App\Api;
use Carbon\Carbon;
use Exception;

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');





class Autofollow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autofollow';

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
        $ac_id = $account->account_id;
        $rule = $account->followrule;
        $moniter = Followmoniter::findOrFail($ac_id);
        $connection = $account->twitterConnection();

        if($account->ruleCheck($rule,$moniter)){

          $friends = $account->getFollowAccounts();

          $keyword = $account->keywordfollow->keyword;
          $target_id = $account->copyfollow->targetid;


          if($keyword != ''){
            $statues = $connection->get("search/tweets", array(
              "q"                 => $keyword,
              "count"             => "50",
              "include_entities"  => "false",
              "lang"              => "ja",
              "locale"            => "ja",
              "result_type"       => "recent",
            ));

            foreach ($statues->statuses as $statue) {

              $id = $statue->user->id;

              if(!in_array($id,$friends)){

                $done = $account->follow($id,$moniter);
                break;

              }
            }


          }else{

          }

          if($target_id != ''){

            $follower = $connection->get('followers/list', array(
              'screen_name' => $target_id
            ));

            $list = array_column($follower->users,'id');


            foreach($list as $id){
              if(!in_array($id,$friends)){

                $account->follow($id,$moniter);
                break;
              }
            }
          }

        }else{

          continue;

        }

      }catch (Exception $e){
        $this->postToDiscord($e->getLine(). "：".$e->getMessage());
      }
    }
  }
}
