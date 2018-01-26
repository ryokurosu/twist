@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">フォロールール設定</div>
            <div class="panel-body">
                <table class="table">
                 <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Account_Id</th>
                    <th scope="col">Keyword</th>
                    <th scope="col">TargetId</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            @foreach($accounts as $account)
            <tr style="height:50px">
                <th scope="row">{{$account->account_id}}</th>
                <td>{{$account->screenname}}</td>
                <td>{{$account->keywordfollow->keyword}}</td>
                <td>{{$account->copyfollow->targetid}}</td>
                <td><a class="btn btn-primary" href="{{url('/follow/target')}}/{{$account->account_id}}">編集</a></td>
            </tr>
            @endforeach
        </table>
    </div>

</div>
</div>
</div>

</div>
</div>
@endsection
