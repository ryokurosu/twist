@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">アカウント管理</div>
      <div class="panel-body">
        <a class="btn btn-info" href="{{url('/account/export/csv')}}">CSVで出力</a>
        <table class="table table-hover col-md-12">
          <thead>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">ステータス</th>
            <th scope="col">電話番号</th>
            <th scope="col">API ConsumerKey</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            @foreach($accounts as $account)
            <tr style="height:50px;">
             <td>{{$account->account_id}}</td>
             <td>{{$account->screenname}}</td>
             <td>
               @if($account->status == 0 || $account->status == 187)
               <a class="btn btn-primary">正常</a>
               @elseif($account->status == 32)
               <a class="btn btn-warning">認証エラー</a>
               @elseif($account->status == 64)
               <a class="btn btn-danger">アカウント凍結</a>
               @elseif($account->status == 88)
               <a class="btn btn-warning">APIリミット</a>
               @elseif($account->status == 93)
               <a class="btn btn-warning">API権限エラー</a>
               @elseif($account->status == 161)
               <a class="btn btn-warning">フォロー制限中</a>
               @elseif($account->status == 292)
               <a class="btn btn-warning">アカウント制限</a>
               @elseif($account->status == 326)
               <a class="btn btn-warning">アカウントロック</a>
               @else
               <a class="btn btn-danger">エラー</a>
               @endif

               @if($account->password == 'public api used')
               <a class="btn btn-info" href="{{url('/account/reapi')}}/{{$account->account_id}}">API再連携</a>
               @endif
             </td>

             <td>{{$account->tel}}</td>
             <td>{{$account->consumerkey}}</td>
             <td><a class="btn btn-primary" href="{{url('/account/edit')}}/{{$account->account_id}}">Edit</a></td>
             <td>
              <a class="btn btn-danger" href="{{url('/account/delete')}}/{{$account->account_id}}" onclick="return confirm('本当にアカウント「{{$account->screenname}}」を削除していいですか？')">Delete</a></td>

            </tr>
            <?php $i++; ?>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
