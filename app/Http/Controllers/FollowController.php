<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Account;
use App\Followrule;
use App\Keywordfollow;
use App\Copyfollow;
use App\Http\Controllers\Controller;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rule(){
        $accounts = Account::where('id',Auth::id())->get();
        return view('follow.rule',[
            'accounts' => $accounts
        ]);
    }
    public function ruleedit($id){
        $account = Account::find($id);
        return view('follow.ruleedit',[
            'account' => $account
        ]);
    }

    public function rulepost(Request $request,$id){
        $followrule = Followrule::where('account_id',$id)->first();
        $request['allowtime'] = implode(',',$request->allowtime);
        $followrule->fill($request->all())->save();
        return $this->ruleedit($id);
    }

    public function target(){
        $accounts = Account::where('id',Auth::id())->get();
        return view('follow.target',[
            'accounts' => $accounts
        ]);
    }
    public function targetedit($id){
        $account = Account::find($id);
        return view('follow.targetedit',[
            'account' => $account
        ]);
    }


    public function targetpost(Request $request,$id){

            $request['keyword'] = !is_null($request['keyword']) ? $request['keyword'] : '';
     $request['targetid'] = !is_null($request['targetid']) ? $request['targetid'] : '';

     
     $keywordfollow = Keywordfollow::where('account_id',$id)->first();



     $keywordfollow->keyword = $request->keyword;
     $keywordfollow->save();

     $copyfollow = Copyfollow::where('account_id',$id)->first();
     $copyfollow->targetid = $request->targetid;
     $copyfollow->save();

     return $this->targetedit($id);
 }
}
