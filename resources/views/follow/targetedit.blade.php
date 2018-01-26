@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
     <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="{{url('/follow/rule')}}">戻る</a>フォロー先編集</div>
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="">
                    <h3>アカウント名：{{$account->screenname}}</h3>


                    <p>キーワード検索</p>   
                    <p>※Twitterの高度な検索にも対応しています</p>   
                    <input class="form-control" name="keyword" id="keyword" type="text" value="{{ $account->keywordfollow->keyword }}"> 
                    <p>コピーフォロワー</p>
                    <p>※フォロー先のIDの@以降の文字を指定してください。</p>
                    <input class="form-control" name="targetid" id="targetid" type="text" value="{{ $account->copyfollow->targetid }}"> 
                    <p></p>
                    <input type="hidden" name="account_id" value="{{$account->account_id}}">

                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>



            </div>
        </div>
    </div>
</div>
</div>
@endsection
