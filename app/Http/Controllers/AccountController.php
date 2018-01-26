<?php

namespace App\Http\Controllers;
require "twitteroauth/autoload.php";
session_start();
session_regenerate_id( true );

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Account;
use App\User;
use App\Api;
use App\Botmoniter;
use App\Followmoniter;
use App\Replymoniter;
use App\Dmmoniter;
use App\Botsetting;
use App\Dmsetting;
use App\Followrule;
use App\Unfollowrule;
use App\Unfollowmoniter;
use App\Copyfollow;
use App\Keywordfollow;
use App\Statistic;
use App\Thanksreply;
use App\Likerule;
use Config;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    return view('account.register');
  }
  public function admin()
  {
    if(Auth::id() != 1){
      return redirect('/');
    }

    $users = User::all();
    return view('admin',
      [
        'users' => $users
      ]);
  }
  public function userdelete($id)
  {
    User::find($id)->delete();
    return $this->admin();
  }
  public function post(Request $request)
  {

    if(Account::where('id',Auth::id())->count() <= User::find(Auth::id())->accountlimit){

      $account = new Account;
      $account->id = Auth::id();
      $account->consumerkey = $request->consumerkey;
      $account->consumersecret = $request->consumersecret;
      $account->accesstoken = $request->accesstoken;
      $account->accesstokensecret = $request->accesstokensecret;
      $account->screenname = $request->screenname;
      $account->password = $request->password;
      $account->tel = $request->tel;
      $account->ip = $request->ip;
      $account->save();

      User::find(Auth::id())->fill(['accountcount' => Account::where('id',Auth::id())->count()])->save();

      $lastid = $account->account_id;

      Followmoniter::create(['account_id' => $lastid]);
      Statistic::create(['account_id' => $lastid]);
      Replymoniter::create(['account_id' => $lastid]);
      Botmoniter::create(['account_id' => $lastid]);
      Dmmoniter::create(['account_id' => $lastid]);
      Unfollowmoniter::create(['account_id' => $lastid]);
      Copyfollow::create(['account_id' => $lastid]);
      Keywordfollow::create(['account_id' => $lastid]);
      Botsetting::create(['account_id' => $lastid]);
      Dmsetting::create(['account_id' => $lastid]);
      Followrule::create(['account_id' => $lastid]);
      Unfollowrule::create(['account_id' => $lastid]);
      Likerule::create(['account_id' => $lastid]);
      Thanksreply::create(['account_id' => $lastid]);

    }

    return view('account.register');
  }


  public function manage()
  {
    $accounts = Account::where('id',Auth::id())->orderBy('id','asc')->get();
    return view('account.manage',['accounts' => $accounts]);
  }

  public function edit($account_id)
  {
    $account = Account::where('account_id',$account_id)->first();
    return view('account.edit',['account' => $account]);
  }
  public function delete($account_id)
  {
    Account::find($account_id)->delete();
    User::find(Auth::id())->fill(['accountcount' => Account::where('id',Auth::id())->count()])->save();
    return $this->manage();
  }

  public function save(Request $request,$account_id)
  {
    Account::where('account_id',$account_id)->first()->fill($request->all())->save();
    $account = Account::where('account_id',$account_id)->first();

    return  view('account.edit',['account' => $account]);
  }
  public function statistic()
  {

    $accounts = Account::where('id',Auth::id())->get();
    return view('account.statistic',['accounts' => $accounts]);
  }

  public function statisticcsv()
  {

    $accounts = Account::where('id',Auth::id())->get();
    return $this->statistic();
  }
  public function reapi($id)
  {

    $account = Account::find($id);
    return $this->apiregist($account->consumerkey,$account->consumersecret,$account->screenname);
  }

  public function apiregist($key = null,$secret = null,$screenname = null)
  {
    $array = Api::where('user_id',Auth::id())->inRandomOrder()->first();
    if(!Api::where('consumerkey',$key)->where('consumersecret',$secret)->exists()){
      $key = null;
      $secret = null;
    }

    $api_key = $key ? $key : $array->consumerkey; 
    $api_secret = $secret ? $secret : $array->consumersecret; 
    $callback_url = Config::get('app.url'). '/account/register/api/return';
    $connection = new TwitterOAuth($api_key, $api_secret);
    $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $callback_url));




    if($key && $secret && $screenname){
      $url = $connection->url('oauth/authorize', array(
        'oauth_token' => $request_token['oauth_token'],
        'screen_name' => $screenname,
        'force_login' => true
      ));
    }else{
     $url = $connection->url('oauth/authorize', array(
      'oauth_token' => $request_token['oauth_token']
    ));
   }

   $_SESSION["api_key"] = $api_key;
   $_SESSION["api_secret"] = $api_secret;
   $_SESSION['oauth_token'] = $request_token['oauth_token'];
   $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

   return redirect($url);
 }

 public function apireturn()
 {
  $api_key = $_SESSION["api_key"];
  $api_secret = $_SESSION["api_secret"];

  if ( isset( $_GET['oauth_token'] ) || isset($_GET["oauth_verifier"]) ) {
    $request_token_secret = $_SESSION["oauth_token_secret"];
    $request_url = "https://api.twitter.com/oauth/access_token";

    $request_method = "POST";
    $signature_key = rawurlencode( $api_secret ) . "&" . rawurlencode( $request_token_secret );


    $params = array(
      "oauth_consumer_key" => $api_key ,
      "oauth_token" => $_GET["oauth_token"] ,
      "oauth_signature_method" => "HMAC-SHA1" ,
      "oauth_timestamp" => time() ,
      "oauth_verifier" => $_GET["oauth_verifier"] ,
      "oauth_nonce" => microtime() ,
      "oauth_version" => "1.0" ,
    );


    foreach( $params as $key => $value ) {
      $params[ $key ] = rawurlencode( $value );
    }


    ksort($params);


    $request_params = http_build_query( $params , "" , "&" );


    $request_params = rawurlencode($request_params);


    $encoded_request_method = rawurlencode( $request_method );


    $encoded_request_url = rawurlencode( $request_url );


    $signature_data = $encoded_request_method . "&" . $encoded_request_url . "&" . $request_params;


    $hash = hash_hmac( "sha1" , $signature_data , $signature_key , TRUE );


    $signature = base64_encode( $hash );


    $params["oauth_signature"] = $signature;


    $header_params = http_build_query( $params, "", "," );


    $context = array(
      "http" => array(
        "method" => $request_method ,  
        "header" => array( 
          "Authorization: OAuth " . $header_params ,
        ) ,
      ) ,
    );


    $curl = curl_init();
    curl_setopt( $curl, CURLOPT_URL , $request_url );
    curl_setopt( $curl, CURLOPT_HEADER, 1 ); 
    curl_setopt( $curl, CURLOPT_CUSTOMREQUEST , $context["http"]["method"] ); 
    curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER , false ); 
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER , true );  
    curl_setopt( $curl, CURLOPT_HTTPHEADER , $context["http"]["header"] );
    curl_setopt( $curl, CURLOPT_TIMEOUT , 5 );
    $res1 = curl_exec( $curl );
    $res2 = curl_getinfo( $curl );
    curl_close( $curl );


    $response = substr( $res1, $res2["header_size"] );
    $header = substr( $res1, 0, $res2["header_size"] );   
    $query = [];
    parse_str( $response, $query );
    echo '<p>下記の認証情報を取得しました。(<a href="' . explode( "?", $_SERVER["REQUEST_URI"] )[0] . '">もう1回やってみる</a>)</p>';

    if(Account::where('screenname',$query['screen_name'] )->exists()){
      $account = Account::where('screenname',$query['screen_name'])->first();
      $account->consumerkey = $api_key;
      $account->consumersecret = $api_secret;
      $account->accesstoken = $query['oauth_token'];
      $account->accesstokensecret = $query['oauth_token_secret'];
      $account->status = 0;
      $account->save();

    }else{
     if(Account::where('id',Auth::id())->count() <= User::find(Auth::id())->accountlimit){

       $account = new Account;
       $account->id = Auth::id();
       $account->consumerkey = $api_key;
       $account->consumersecret = $api_secret;
       $account->accesstoken = $query['oauth_token'];
       $account->accesstokensecret = $query['oauth_token_secret'];
       $account->screenname = $query['screen_name'];
       $account->password = 'public api used';
       $account->tel = 'public api used';
       $account->ip = 'public api used';
       $account->save();

       User::find(Auth::id())->fill(['accountcount' => Account::where('id',Auth::id())->count()])->save();

       $lastid = $account->account_id;

       Followmoniter::create(['account_id' => $lastid]);
       Statistic::create(['account_id' => $lastid]);
       Replymoniter::create(['account_id' => $lastid]);
       Botmoniter::create(['account_id' => $lastid]);
       Dmmoniter::create(['account_id' => $lastid]);
       Unfollowmoniter::create(['account_id' => $lastid]);
       Copyfollow::create(['account_id' => $lastid]);
       Keywordfollow::create(['account_id' => $lastid]);
       Botsetting::create(['account_id' => $lastid]);
       Dmsetting::create(['account_id' => $lastid]);
       Followrule::create(['account_id' => $lastid]);
       Unfollowrule::create(['account_id' => $lastid]);
       Thanksreply::create(['account_id' => $lastid]);
       Likerule::create(['account_id' => $lastid]);
     }
   }

 } elseif ( isset( $_GET["denied"] ) ) {
  echo "連携を拒否しました。";
} else{
  echo 'false';
}
return redirect('/account/register/');
}
}
