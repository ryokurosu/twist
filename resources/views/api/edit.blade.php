@extends('layouts.app')

@section('content')
<div class="container">

 <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="{{url('/api')}}">戻る</a>API Keyの登録</div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{url('/api/edit')}}/{{$api->id}}">
                    <h3>コンシューマーキー</h3>
                    <input class="form-control" name="consumerkey" id="consumerkey" type="text" value="{{$api->consumerkey}}" required> 
                    <p>Twitter Application ManagementのConsumer Key (API Key)を入力して下さい。</p>
                    <h3>コンシューマシークレット</h3>
                    <input class="form-control" name="consumersecret" type="text" value="{{$api->consumersecret}}" required> 
                    <p>Twitter Application ManagementのConsumer Secret (API Secret)を入力して下さい。</p>
                    <button class="btn btn-primary" type="submit">登録</button>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
