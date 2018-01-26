@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">ユーザー管理</div>
      <div class="panel-body">
        <table class="table table-hover col-md-12">
          <thead>
            <th scope="col">ID</th>
            <th scope="col">名前</th>
            <th scope="col">アカウント登録数</th>
            <th scope="col">アカウント数上限</th>
            <th scope="col">Delete</th>
          </thead>
          <tbody>
            @foreach($users as $u)
            <tr style="height:50px;">
             <td>{{$u->id}}</td>
             <td>{{$u->name}}</td>
             <td>{{$u->accountcount}}</td>
             <td>{{$u->accountlimit}}</td>
             <td><a class="btn btn-danger" href="{{url('/admin/user/delete')}}/{{$u->id}}" onclick="return confirm('本当にユーザー「{{$u->name}}」を削除していいですか？')">Delete</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
