<?php

namespace App\Console\Commands;
require "twitteroauth/autoload.php";

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Account;
use App\Follower;
use App\Likerule;
use Carbon\Carbon;
use Exception;
use App\Api;

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');





class Autolike extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autolike';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'autolike now';

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
        $consumerKey = $account->consumerkey; 
        $consumerSecret = $account->consumersecret; 
        $accessToken = $account->accesstoken; 
        $accessTokenSecret = $account->accesstokensecret;
        $screenname = $account->screenname;
        $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

        $ac_id = $account->account_id;
        $likerule = Likerule::find($ac_id);


        if($likerule->text != '' && in_array(date('G'),explode(',',$likerule->allowtime))){


         $db_path ="./".$account->screenname."_favo.db";
         $db = @unserialize(file_get_contents($db_path));
         if (!$db) { $db = array();} 

         $statues = $connection->get("search/tweets", array(
          "q"                 => $likerule->text,
          "count"             => "5",
          "include_entities"  => "false",
          "lang"              => "ja",
          "locale"            => "ja",
          "result_type"       => "recent",
        ));

         foreach ($statues->statuses as $list) {
          $favo_list[] = @$list->id;
        }

        file_put_contents($db_path, serialize($favo_list));
        $favo_list = array_unique($favo_list);
        $favo_list = array_diff($favo_list,$db);

        foreach ($favo_list as $value) {
          $statues = $connection->post("favorites/create", array(
            "id" => $value,
            "include_entities" => "false"
          ));

          $account->status = 0;
          $account->save();

        }
      }else{
        continue;
      }
    }catch (Exception $e){
      echo '捕捉した例外: ',  $e->getMessage(), "\n";
      continue;
    }
  }
}
}
