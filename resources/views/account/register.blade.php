@extends('layouts.app')

@section('content')
<div class="container">

 <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">アカウントの登録・更新</div>
            <div class="panel-body">
                <a class="btn btn-info" href="{{url('/account/register/api')}}">API経由で登録する</a>
                <form class="form-horizontal" method="POST" action="{{url('/account/register')}}">
                    <h3>コンシューマキー</h3>
                    <input class="form-control" name="consumerkey" id="consumerkey" type="text" value="{{ old('consumerkey') }}" required> 
                    <p>Twitter Application ManagementのConsumer Key (API Key)を入力して下さい。</p>
                    <h3>コンシューマシークレット</h3>
                    <input class="form-control" name="consumersecret" type="text" value="{{ old('consumersecret') }}"  required> 
                    <p>Twitter Application ManagementのConsumer Secret (API Secret)を入力して下さい。</p>
                    <h3>アクセストークン</h3>
                    <input class="form-control" name="accesstoken" type="text" value="{{ old('accesstoken') }}"  required> 
                    <p>Twitter Application ManagementのAccess Tokenを入力して下さい。</p>
                    <h3>アクセストークンシークレット</h3>
                    <input class="form-control" name="accesstokensecret" type="text" value="{{ old('accesstokensecret') }}"  required> 
                    <p>Twitter Application ManagementのAccess Token Secretを入力して下さい。</p>
                    <h3>ID</h3>
                    <input class="form-control" name="screenname" type="text" value="{{ old('screenname') }}"  required> 
                    <p>アカウントのIDを入力してください。</p>
                    <h3>パスワード</h3>
                    <input class="form-control" name="password" type="text" value="{{ old('password') }}"  required> 
                    <p>アカウントのパスワードを入力してください。</p>
                    <h3>電話番号</h3> 
                    <input class="form-control" name="tel" type="text" value="{{ old('tel') }}"  required> 
                    <p>アカウントの電話番号を入力してください。</p>
                    <h3>プロキシアドレス</h3>
                    <input class="form-control" name="ip" type="text" value="{{ old('ip') }}"  required> 
                    <p>登録・更新するアカウントのプロキシアドレスを指定して下さい。</p>
                    <p></p>
                    <button class="btn btn-primary" type="submit">登録</button>
                    {{ csrf_field() }}

                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
