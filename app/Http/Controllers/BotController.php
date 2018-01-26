<?php

namespace App\Http\Controllers;
require "twitteroauth/autoload.php";

mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Botstory;
use App\Botrule;
use App\Storytext;
use App\Account;
use App\Botsetting;

class BotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function set(){
        $accounts = Account::where('id',Auth::id())->get();
        return view('bot.setting',
            [
                'accounts' => $accounts
            ]
        );
    }

    public function setedit($account_id){
        $account = Auth::user()->accounts()->findOrFail($account_id);
        return view('bot.settingedit',
            [
                'ac' => $account,
                'rules' => Botrule::where('id',Auth::id())->get(),
                'stories' => Botstory::where('id',Auth::id())->get()
            ]
        );
    }

    public function setpost(Request $request){
        $s = Botsetting::where('account_id',$request->account_id)->first();
        $s->fill($request->all())->save();
        return $back();
    }


    public function story()
    {

        $stories = Botstory::where('id',Auth::id())->get();

        return view('bot.story',
            ['stories' => $stories]
        );
    }

    public function storycreate(Request $request)
    {

        $story = Botstory::create([
            'id' => Auth::id(),
            'name' => $request->name
        ]);
        return back();
    }

    public function storyChange($botstory_id,Request $request){
        Botstory::findOrFail($botstory_id)->fill($request->all())->save();
        return back();
    }

    public function storyedit($botstory_id)
    {
        $storytexts = Storytext::where('story_id',$botstory_id)->get();
        $botstory = Botstory::findOrFail($botstory_id);
        return view('bot.storytext',['storytexts' => $storytexts,'botstory' => $botstory]);
    }

    public function storyadd(Request $request,$botstory_id)
    {
        $path = [];

        if(!is_null($request['data_file'])){
            $request['data_file'] = array_filter($request['data_file'], "strlen");
            $request['data_file'] = array_values($request['data_file']);
            foreach($request->data_file as $image){
                $save_filename = date('YmdHis');
                $save_basename = $save_filename. '-'. $image->getClientOriginalName();
                if(preg_match('/.mp4/',$save_basename)){
                    $image->move(public_path() . '/image/' ,$save_basename);
                }else{
                    Image::make($image)->save(public_path() . '/image/' .$save_basename);
                }
                $path[] = $save_basename; 
            }
        }

        if(is_null($request['text'])){
            $request['text'] = '';
        }
        $storytexts = new Storytext;
        $storytexts->story_id = $botstory_id;
        $storytexts->text = $request->text;
        $storytexts->file = implode(',',$path);
        $storytexts->save();


        $count = Storytext::where('story_id',$botstory_id)->count();
        Botstory::find($botstory_id)->fill(['count' => $count])->save();
        return $this->storyedit($botstory_id);
    }

    public function storydelete($botstory_id,$text_id)
    {
        Storytext::where('text_id',$text_id)->delete();
        $count = Storytext::where('story_id',$botstory_id)->count();
        Botstory::find($botstory_id)->fill(['count' => $count])->save();
        return $this->storyedit($botstory_id);
    }

    public function rule()
    {
        $id = Auth::id();
        $botrules = Botrule::where('id',$id)->get();
        return view('bot.rule',['botrules' => $botrules]);
    }

    public function rulecreate(Request $request)
    {

        $request['allowtime'] = implode(',',$request->allowtime);
        $rule = Botrule::create($request->all());
        return back();
    }

    public function ruledelete($botrule_id){
        Botrule::find($botrule_id)->delete();
        Botsetting::where('botrule_id',$botrule_id)->update(['botrule_id' => 0]);
        return $this->rule();
    }
    public function sdelete($botstory_id){
        Botstory::find($botstory_id)->delete();
        Botsetting::where('botstory_id',$botstory_id)->update(['botstory_id' => 0]);
        return $this->story();
    }
    public function ruleedit($botrule_id)
    {
        $id = Auth::id();
        $botrules = Botrule::where('id',$id)->findOrFail($botrule_id);
        return view('bot.edit',['rule' => $botrules]);
    }

    public function rulechange(Request $request,$botrule_id)
    {
        $b = Botrule::findOrFail($botrule_id);
        $request['allowtime'] = implode(',',$request->allowtime);
        $b->fill($request->all())->save();
        return back();
    }

    public function copy($botstory_id)
    {
     $storytexts = Storytext::where('story_id',$botstory_id)->get();
     return view('bot.copytext',['storytexts' => $storytexts]);
 }

 public function copyadd(Request $request,$botstory_id)
 {
    $keyword = $request->text;
    $retweet = $request->retweet;
    $fav = $request->fav;
    $account = Account::where('id',Auth::id())->first();
    $connection = new TwitterOAuth($account->consumerkey, $account->consumersecret, $account->accesstoken, $account->accesstokensecret);

    $tweets = $connection->get('search/tweets',[
        'q' => $keyword.' exclude:retweets min_retweets:'.$retweet.' min_faves:'.$fav,
        'lang' => 'ja',
        'locale' => 'ja',
        'result_type' => 'recent',
        'count' => '50'
    ]);

    foreach($tweets->statuses as $tweet){
        $storytext = new Storytext;
        $storytext->story_id = $botstory_id;
        $storytext->text = $tweet->text;
        $storytext->save();
    }

    $count = Storytext::where('story_id',$botstory_id)->count();
    Botstory::find($botstory_id)->fill(['count' => $count])->save();


    return $this->copy($botstory_id);
}
}
