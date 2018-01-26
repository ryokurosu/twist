<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Account;
use App\Follower;
use App\Dmrule;
use App\Dmsetting;
use App\Dmstory;
use App\Dmtext;
use App\Dmmoniter;
use Carbon\Carbon;
use Exception;
use App\Api;

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');





class ThanksDM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thanksdm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'thanksdm now';

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
        $moniter = Dmmoniter::findOrFail($account->account_id);


        $dmsetting = Dmsetting::where('account_id',$ac_id)->firstOrFail();
        $dmrule_id = $dmsetting->dmrule_id;
        $dmstory_id = $dmsetting->dmstory_id;

        $rule = Dmrule::findOrFail($dmrule_id);
        $story = Dmtext::where('dmstory_id',$dmstory_id)->get();

        $follower = Follower::where('account_id',$ac_id)->where('dmwait',0)->orderby('updated_at','asc')->firstOrFail();

        if($account->ruleCheck($rule,$moniter,$follower)){
          $account->sendDM($follower->target_id,$moniter,$story);
        }

      }catch (Exception $e){
        $this->postToDiscord($e->getLine(). "：".$e->getMessage());
      }
    }
  }
}
