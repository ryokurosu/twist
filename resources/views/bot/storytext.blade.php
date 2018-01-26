@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading"><a href="{{url('/bot/story')}}">戻る</a>ツイート追加</div>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{url('/bot/story/edit')}}/{{$botstory->botstory_id}}" enctype="multipart/form-data">
                    <p>ツイート</p>
                    <textarea class="form-control" name="text" id="text" type="text" onkeyup="updateCount(value, 'count',140)">{{ old('text') }}</textarea>
                    <span id="count">140</span>

                    <script type="text/javascript">
                        updateCount = function(str, id, max){
                            var obj = document.getElementById(id);
                            if(str) {
                                obj.innerHTML = twttr.txt.getTweetLength(str);
                            }
                            else {
                                obj.innerHTML = max;
                            }
                        };
                    </script>

                    <p>画像</p>
                    <input type="file" name="data_file[]" accept="image/*" class="form-control-file">
                    <input type="file" name="data_file[]" accept="image/*" class="form-control-file">
                    <input type="file" name="data_file[]" accept="image/*" class="form-control-file">
                    <input type="file" name="data_file[]" accept="image/*" class="form-control-file">


                    <p>動画</p>
                    <p>※現在Twitterの仕様の為、使うことが出来ません。</p>
                    <!-- <input type="file" name="data_file[]" class="form-control-file"> -->

                    {{ csrf_field() }}
                    <p></p>
                    <button class="btn btn-primary" type="submit">追加</button>
                    <a class="btn btn-default" href="{{url('/bot/story/copy')}}/{{$botstory->botstory_id}}">キーワードで一括追加</a>
                    <a class="btn btn-default" href="{{url('/bot/story/csv')}}/{{$botstory->botstory_id}}">CSVで一括追加</a>
                    <a class="btn btn-info" href="{{url('/bot/story/export/csv')}}/{{$botstory->botstory_id}}">CSVで出力</a>
                </form>

            </div>
        </div>

        <div class="panel panel-default">

            <div class="panel-heading">ストーリー名変更</div>
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="{{route('bot.story.change',$botstory->botstory_id)}}">
                    <p>ボットストーリー名</p>
                    <input name="name" id="name" type="text" value="{{$botstory->name}}" required> 
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>

            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading"><a href="{{url('/bot/story')}}"></a>ツイート一覧</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th scope="col">Number</th>
                        <th scope="col">Tweet</th>
                        <th scope="col">File</th>
                        <th scope="col">Delete</th>
                    </thead>
                    <?php $i = 1; ?>
                    @foreach($storytexts as $text)
                    <tr>
                        <td>{{$i}}<?php $i++;?></td>
                        <td>{!!nl2br(e($text->text))!!}</td>
                        <td>
                            <?php $array = explode(',',$text->file); ?>
                            @foreach($array as $src)
                            <img src="/twist/public/image/{{$src}}" alt="{{$src}}" style="max-width:60px;max-height:60px;">
                            
                            @endforeach
                        </td>
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
