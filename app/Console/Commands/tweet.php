<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Account;
use App\Botrule;
use App\Botstory;
use App\Botmoniter;
use App\Storytext;
use Carbon\Carbon;
use App\Api;
use Exception;




class Tweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'tweet now';

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


       $storytexts = Storytext::where('story_id',$account->botsetting->botstory_id)->get();
       $rule = Botrule::where('botrule_id',$account->botsetting->botrule_id)->first();
       $moniter = Botmoniter::find($account->account_id);


       if($account->ruleCheck($rule,$moniter)){
        $tweet = $storytexts[rand(0,count($storytexts)-1)];

        $filearray = explode(',',$tweet->file);

        $filearray = array_filter($filearray);
        $media_ids = [];

        if ( $filearray && is_array($filearray) ) {
          $basepath = public_path('image/');
          foreach ($filearray as $file) {
            $filepath = $basepath.$file;
            if(file_exists($filepath) && exif_imagetype($filepath)){

              $r = $connection->upload('media/upload',[
                'media' => $filepath
              ]);
              $media_ids[] = $r->media_id_string;
            }else{
              $data = file_get_contents($filepath); 
              $r = $connection->post('media/upload',[
                "command" => "INIT",
                "media_type" => "video/mp4",
                "total_bytes" => filesize($filepath)
              ]);
              $media_ids[] = $r->media_id_string;
            }
          }
        }

        $response = $connection->post("statuses/update",[
          'media_ids' => implode(',',$media_ids), 
          'status' => $tweet->text //$tweet->text
        ]);
        $account->done($response,$moniter);
        
      }else{
        continue;
      }
    }catch (Exception $e){
     $this->postToDiscord($e->getLine(). "：".$e->getMessage());
   }

 }

}
}
