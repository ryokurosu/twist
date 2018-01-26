@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">ボット設定</div>
                <div class="panel-body">

                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">AccountId</th>
                            <th scope="col">Name</th>
                            <th scope="col">Botrule</th>
                            <th scope="col">Botstory</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($accounts as $ac)
                     <tr style="height:50px">
                        <th scope="row">{{$ac->account_id}}</th>
                        <td>{{$ac->account_id}}</td>
                        <td>{{$ac->screenname}}</td>
                        <td>{{$ac->dmsetting->rule->name}}</td>
                        <td>{{$ac->dmsetting->story->name}}</td>
                        <td><a class="btn btn-primary" href="{{url('/')}}/dm/setting/edit/{{$ac->account_id}}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

</div>
</div>
@endsection
