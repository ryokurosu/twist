<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Account;
use App\Followrule;
use App\Unfollowrule;
use App\Keywordfollow;
use App\Copyfollow;
use App\Http\Controllers\Controller;

class UnfollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $accounts = Account::where('id',Auth::id())->get();
        return view('unfollow.index',[
            'accounts' => $accounts
        ]);
    }
    public function ruleedit($id){
        $account = Account::find($id);
        return view('unfollow.rule',[
            'account' => $account
        ]);
    }

    public function rulepost(Request $request,$id){
        $unfollowrule = Unfollowrule::where('account_id',$id)->first();
        $request['allowtime'] = implode(',',$request->allowtime);
        $unfollowrule->fill($request->all())->save();
        return $this->ruleedit($id);
    }
}
