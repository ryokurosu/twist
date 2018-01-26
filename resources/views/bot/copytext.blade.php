@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading"><a href="{{url('/bot/story')}}">戻る</a>キーワードから一括追加</div>
                <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="">
                    <p></p>
                    <div class="input-group mb-2 mb-sm-0">
                        <div class="input-group-addon">キーワード</div>
                        <input class="form-control" name="text" id="text" type="text" value="{{ old('text') }}" required> 
                    </div>
                    <p></p>
                    <div class="input-group mb-2 mb-sm-0">
                        <div class="input-group-addon">最低リツイート数</div>
                        <input class="form-control" name="retweet" id="retweet" type="number" value="{{ old('retweet',0) }}" required> 
                    </div>
                    <p></p>
                    <div class="input-group mb-2 mb-sm-0">
                        <div class="input-group-addon">最低ファボ数</div>
                        <input class="form-control" name="fav" id="fav" type="number" value="{{ old('fav',0) }}" required> 
                    </div>
                    {{ csrf_field() }}
                    <p></p>
                    <button class="btn btn-primary" type="submit">抽出</button>
                </form>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">ツイート一覧</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th scope="col">Number</th>
                        <th scope="col">Tweet</th>
                        <th scope="col">Delete</th>
                    </thead>
                    <?php $i = 1; ?>
                    @foreach($storytexts as $text)
                    <tr>
                        <td>{{$i}}<?php $i++;?></td>
                        <td>{{$text->text}}</td>
                        <td><a class="btn btn-danger" href="{{url('/bot/story/edit')}}/{{$text->story_id}}/delete/{{$text->text_id}}">削除</a></td>
                    </tr>
                    @endforeach



                </div>
            </div>
        </div>
    </div>

</div>






</table>


@endsection
