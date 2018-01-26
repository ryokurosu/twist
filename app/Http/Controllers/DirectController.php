<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Botstory;
use App\Botrule;
use App\Dmtext;
use App\Dmstory;
use App\Dmrule;
use App\Account;
use App\Dmsetting;
use App\Thanksreply;
use App\Likerule;

class DirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function set(){
        $accounts = Account::where('id',Auth::id())->get();
        return view('dm.setting',
            [
                'accounts' => $accounts
            ]
        );
    }

    public function setedit($id){
        $account = Account::where('account_id',$id)->where('id',Auth::id())->first();
        $rules = Dmrule::where('id',Auth::id())->get();
        $stories = Dmstory::where('id',Auth::id())->get();

        return view('dm.settingedit',
            [
                'ac' => $account,
                'rules' => $rules,
                'stories' => $stories
            ]
        );
    }

    public function setpost(Request $request){

        $s = Dmsetting::where('account_id',$request->account_id)->firstOrFail();
        $s->fill($request->all())->save();
        return back();
    }


    public function story()
    {

        $stories = Dmstory::where('id',Auth::id())->get();

        return view('dm.story',
            ['stories' => $stories]
        );
    }

    public function storycreate(Request $request)
    {

        $story = new Dmstory;
        $story->id = Auth::id();
        $story->name = $request->name;
        $story->save();

        return back();
    }
    public function sdelete($id)
    {
        Dmstory::find($id)->delete();
        Dmsetting::where('dmstory_id',$id)->update(['dmstory_id' => 0]);
        return $this->story();
    }
    public function storyedit($id)
    {
        $storytexts = Dmtext::where('dmstory_id',$id)->get();
        $story = Dmstory::findOrFail($id);
        return view('dm.storytext',['storytexts' => $storytexts,'story' => $story]);
    }

    public function storyadd(Request $request,$id)
    {
        $storytexts = new Dmtext;
        $storytexts->dmstory_id = $id;
        $storytexts->text = $request->text;
        $storytexts->save();

        Dmstory::find($id)->fill(['count' => Dmtext::where('dmstory_id',$id)->count()])->save();

        return $this->storyedit($id);
    }
    public function storyChange(Request $request,$id){
        Dmstory::findOrFail($id)->fill($request->all())->save();
        return back();
    }
    public function storydelete($id,$text_id)
    {
        Dmtext::where('dmtext_id',$text_id)->delete();
        Dmstory::find($id)->fill(['count' => Dmtext::where('dmstory_id',$id)->count()])->save();
        return $this->storyedit($id);
    }

    public function rule()
    {
        $rules = Dmrule::where('id',Auth::id())->get();
        return view('dm.rule',['rules' => $rules]);
    }

    public function delete($id){
        Dmrule::find($id)->delete();
        Dmsetting::where('dmrule_id',$id)->update(['dmrule_id' => 0]);
        return $this->rule();

    }

    public function rulecreate(Request $request)
    {
        $request['allowtime'] = implode(',',$request->allowtime);

        $rule = new Dmrule;
        $rule->id = Auth::id();
        $rule->fill($request->all())->save();
        return back();
    }

    public function ruleedit($id)
    {
        $rule = Dmrule::where('dmrule_id',$id)->where('id',Auth::id())->first();
        return view('dm.edit',['rule' => $rule]);
    }

    public function rulechange(Request $request,$id)
    {
        $request['allowtime'] = implode(',',$request->allowtime);
        Dmrule::findOrFail($id)->fill($request->all())->save();
        return back();
    }

    public function reply(){
      $accounts = Account::where('id',Auth::id())->get();
      return view('reply.index',
        [
            'accounts' => $accounts
        ]
    );
  }

  public function replyedit($id){
      $account = Account::find($id);

      return view('reply.edit',
        [
            'account' => $account
        ]
    );
  }

  public function replypost(Request $request,$id){
    $request['text'] = is_null($request->text) ? '' : $request->text;
    $request['allowtime'] = implode(',',$request->allowtime);
    $t = Thanksreply::find($id);
    $t->fill($request->all())->save();
    return $this->reply();
}


public function like(){
  $accounts = Account::where('id',Auth::id())->get();
  return view('like.index',
    [
        'accounts' => $accounts
    ]
);
}

public function likeedit($id){
  $account = Account::find($id);

  return view('like.edit',
    [
        'account' => $account
    ]
);
}

public function likepost(Request $request,$id){
    $request['text'] = is_null($request->text) ? '' : $request->text;
    $request['allowtime'] = implode(',',$request->allowtime);
    $t = Likerule::find($id);
    $t->fill($request->all())->save();
    return $this->like();
}








}
