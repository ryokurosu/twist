<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Account;
use App\User;
use App\Botmoniter;
use App\Followmoniter;
use App\Replymoniter;
use App\Dmmoniter;
use App\Storytext;
use App\Botsetting;
use App\Dmsetting;
use App\Followrule;
use App\Unfollowrule;
use App\Copyfollow;
use App\Keywordfollow;
use App\Statistic;
use App\Thanksreply;
use App\Unfollowmoniter;
use App\Api;
use Exception;

use App\Http\Controllers\Controller;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class CsvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function csv(){
        return view('account.csv');
    }

    public function csvregist(Request $request){

        $data = $request->data_file;

        $config = new LexerConfig();
        $config->setDelimiter(",");

        $interpreter = new Interpreter();
        $lineNumber = 0;
        $interpreter->addObserver(function(array $columns)  use (&$lineNumber) {
    // CSVファイルを1行ずつ処理
           $lineNumber += 1;
           if($columns[0] == '' || $lineNumber === 1){return;}
           try{

            if(Account::where('id',Auth::id())->count() <= User::find(Auth::id())->accountlimit){

                $account = new Account;
                $account->id = Auth::id();
                $account->consumerkey = $columns[0];
                $account->consumersecret = $columns[1];
                $account->accesstoken = $columns[2];
                $account->accesstokensecret = $columns[3];
                $account->screenname = $columns[4];
                $account->password = $columns[5];
                $account->tel = $columns[6];
                $account->ip = $columns[7];
                $account->save();

                $lastid = $account->account_id;


                Followmoniter::create(['account_id' => $lastid]);
                Statistic::create(['account_id' => $lastid]);
                Replymoniter::create(['account_id' => $lastid]);
                Unfollowmoniter::create(['account_id' => $lastid]);
                Botmoniter::create(['account_id' => $lastid]);
                Dmmoniter::create(['account_id' => $lastid]);
                Copyfollow::create(['account_id' => $lastid]);
                Keywordfollow::create(['account_id' => $lastid]);
                Botsetting::create(['account_id' => $lastid]);
                Dmsetting::create(['account_id' => $lastid]);
                Followrule::create(['account_id' => $lastid]);
                Unfollowrule::create(['account_id' => $lastid]);
                Thanksreply::create(['account_id' => $lastid]);
            }

        }catch (Exception $e){

        }

    });

        $lexer = new Lexer($config);
        $lexer->parse($data, $interpreter);
        User::find(Auth::id())->fill(['accountcount' => Account::where('id',Auth::id())->count()])->save();
        return redirect('/account/manage');

    }
    public function exportcsv(){

        $accounts = Account::where('id',Auth::id())->get();
        $stream = fopen('php://temp','w');

        fputcsv($stream,[
            'ConsumerKey',
            'ConsumerSecret',
            'AccessToken',
            'AccessTokenSecret',
            'ID',
            'Password',
            'Tel',
            'IP'
        ]);
        //loop
        foreach($accounts as $account)
        {   
            fputcsv($stream,[
                $account->consumerkey,
                $account->consumersecret,
                $account->accesstoken,
                $account->accesstokensecret,
                $account->screenname,
                $account->password,
                $account->tel,
                $account->ip
            ]);
        }

        rewind($stream);
        $csv = mb_convert_encoding(str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)), 'SJIS', 'UTF-8');
        $filename = "accounts_".Auth::user()->name."_".date('Ymd').".csv";

        //header
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        );

        return \Response::make($csv, 200, $headers);
    }




    public function bottextcsv($id)
    {
        return view('bot.csv',['botstory_id' => $id]);
    }

    public function bottextcsvimport(Request $request,$id)
    {
      $data = $request->data_file;

      $config = new LexerConfig();
      $config->setDelimiter(",");
      $interpreter = new Interpreter();
      $interpreter->addObserver(function(array $columns) use ($id) {
    // CSVファイルを1行ずつ処理
        if($columns[0] == ''){return 0;}
        Storytext::create([
            'story_id' => $id,
            'text' => $columns[0]
        ]);
    });

      $lexer = new Lexer($config);
      $lexer->parse($data, $interpreter);

      $count = Storytext::where('story_id',$id)->count();
      Botstory::find($id)->fill(['count' => $count])->save();
      return redirect('/bot/story/edit/'.$id);
  }
  public function bottextexportcsv($id){

    $storytexts = Storytext::where('story_id',$id)->get();
    $stream = fopen('php://temp','w');
    foreach($storytexts as $text)
    {   
        if($text->text != ''){
            fputcsv($stream,[
                $text->text
            ]);
        }
    }

    rewind($stream);
    $csv = mb_convert_encoding(str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)), 'SJIS', 'UTF-8');
    $filename = "tweets_".Auth::user()->name."_".date('Ymd').".csv";

        //header
    $headers = array(
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"'
    );

    return \Response::make($csv, 200, $headers);
}
public function api(){
    return view('api.csv');
}
public function apipost(Request $request){
 $data = $request->data_file;

 $config = new LexerConfig();
 $config->setDelimiter(",");

 $interpreter = new Interpreter();
 $lineNumber = 0;
 $interpreter->addObserver(function(array $columns) use (&$lineNumber) {
    // CSVファイルを1行ずつ処理
    $lineNumber += 1;
    if($columns[0] == '' || $lineNumber === 1){return;}
    try{
        Api::create(['user_id' => Auth::id(),'consumerkey' => $columns[0],'consumersecret' => $columns[1]]);
    }catch (Exception $e){

    }

});

 $lexer = new Lexer($config);
 $lexer->parse($data, $interpreter);

 return back();
}



}
