@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">DM文章追加</div>
                <div class="panel-body">

                  <form class="form-horizontal" method="POST" action="{{url('/dm/story/edit')}}/{{$story->dmstory_id}}">
                    <p>DM文章</p>
                    <textarea class="form-control" name="text" id="text" type="text" required>{{ old('text') }}</textarea>
                    <p>ランダムにどれか一つが送られます。</p>
                    {{ csrf_field() }}
                    <p></p>
                    <button class="btn btn-primary" type="submit">追加</button>
                </form>

            </div>
        </div>

        <div class="panel panel-default">

                <div class="panel-heading">DM文章セット名変更</div>
                <div class="panel-body">

                  <form class="form-horizontal" method="POST" action="{{route('dm.story.change',$story->dmstory_id)}}">
                    <p>DM文章セット名</p>
                    <input class="form-control" name="name" id="name" type="text" value="{{$story->name}}" required>
                    <p></p>
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">追加</button>
                </form>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">DMテキスト一覧</div>
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
                        <td>{!!nl2br(e($text->text))!!}</td>
                        <td><a href="{{url('/dm/story/edit')}}/{{$text->dmstory_id}}/delete/{{$text->dmtext_id}}">削除</a></td>
                    </tr>
                    @endforeach



                </div>
            </div>
        </div>
    </div>

</div>






</table>


@endsection
