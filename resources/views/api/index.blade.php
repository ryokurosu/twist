@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">アカウント管理</div>
      <div class="panel-body">
        <div>
          <a class="btn btn-primary" href="{{url('/api/regist')}}">API新規登録</a>
          <a class="btn btn-default" href="{{url('/api/csv/regist')}}">CSVで一括登録</a>
        </div>
        <table class="table table-hover col-md-12">
          <thead>
            <th scope="col">ID</th>
            <th scope="col">コンシューマーキー</th>
            <th scope="col">コンシューマーシークレット</th>
            <th scope="col">ステータス</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </thead>
          <tbody>
            @foreach($apis as $a)
            <tr style="height:50px;">
             <td>{{$a->id}}</td>
             <td>{{$a->consumerkey}}</td>
             <td>{{$a->consumersecret}}</td>
             <td>
              @if($a->status == 0 || $a->status == 187)
              <a class="btn btn-primary">正常</a>
              @elseif($a->status == 32)
              <a class="btn btn-warning">認証エラー</a>
              @else
              <a class="btn btn-danger">エラー</a>
              @endif
            </td>
            <td><a class="btn btn-primary" href="{{url('/api/edit')}}/{{$a->id}}">Edit</a></td>
            <td>
              <a class="btn btn-danger" href="{{url('/api/delete')}}/{{$a->id}}" onclick="return confirm('本当に削除していいですか？')">Delete</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
