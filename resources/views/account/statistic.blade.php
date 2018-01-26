@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">アカウント管理</div>
            <div class="panel-body">
                <table class="table col-md-12">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">1日前</th>
                        <th scope="col">2日前</th>
                        <th scope="col">3日前</th>
                        <th scope="col">4日前</th>
                        <th scope="col">5日前</th>
                    </thead>
                    <tbody>
                        @foreach($accounts as $account)

                        <tr>
                           <td rowspan="2">{{$account->account_id}}</td>
                           <td rowspan="2">{{$account->screenname}}</td>

                           @for($i = 0;$i < 5;$i++)
                           <td>Follow:{{ isset($account->statis[$i]) ? $account->statis[$i]->follow : 0 }}</td>
                           @endfor
                       </tr>
                       <tr>
                          @for($i = 0;$i < 5;$i++)
                           <td>Follower:{{ isset($account->statis[$i]) ? $account->statis[$i]->follower : 0 }}</td>
                           @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
