@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ダッシュボード</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>Name:{{Auth::user()->name}}</p>              
                    <p>登録アカウント数:{{Auth::user()->accountcount}}/{{Auth::user()->accountlimit}}個</p>              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
