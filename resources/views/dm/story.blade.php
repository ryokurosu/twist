@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">DM文章セット追加</div>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{url('/dm/story')}}">


                        <p>DM文章セット名</p>
                        <input name="name" id="name" type="text" value="{{ old('name','Default Name') }}" required> 
                        {{ csrf_field() }}
                        <button class="btn btn-primary" type="submit">作成</button>
                    </form>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">ストーリー一覧</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Count</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </thead>

                        <tbody>
                            @foreach($stories as $story)
                            <tr style="height:50px;">
                                <td>{{$story->dmstory_id}}</td>
                                <td>{{$story->name}}</td>
                                <td>{{$story->count}}</td>
                                <td><a class="btn btn-primary" href="{{url('/dm/story/edit')}}/{{$story->dmstory_id}}">Edit</a></td>
                                <td><a class="btn btn-danger" href="{{url('/dm/story/delete')}}/{{$story->dmstory_id}}">Delete</a></td>
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
