<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Account;
use App\User;
use App\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $apis = Api::where('user_id',Auth::id())->get();
    return view('api.index',[
      'apis' => $apis
    ]);
  }

  public function regist()
  {
    return view('api.regist');
  }

  public function registpost(Request $request)
  {
    Api::create(['user_id' => Auth::id(),'consumerkey' => $request->consumerkey,'consumersecret' => $request->consumersecret]);
    return $this->regist();
  }
  public function edit($id)
  {
    $api = Api::find($id);
    return view('api.edit',[
      'api' => $api
    ]);
  }

  public function editpost(Request $request,$id)
  {
    Api::find($id)->fill($request->all())->save();
    return $this->edit($id);
  }

   public function delete($id)
  {
    Api::where('user_id',Auth::id())->find($id)->delete();
    return back();
  }

}
