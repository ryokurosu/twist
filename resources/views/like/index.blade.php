<?php mb_internal_encoding("UTF-8"); ?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">LIKEルール設定</div>
                <div class="panel-body">

                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Text</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($accounts as $ac)
                       <tr style="height:50px">
                        <td>{{$ac->screenname}}</td>
                        <?php $rep =  strlen($ac->like->text) > 32 ? nl2br(e(mb_substr($ac->like->text,0,21))).'...' : nl2br(e($ac->like->text)) ; ?>
                        <td>{!! $rep !!}</td>
                        <td><a class="btn btn-primary" href="{{url('/like/edit/')}}/{{$ac->account_id}}">Edit</a></td>
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
