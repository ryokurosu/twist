@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
     <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="{{url(('/bot/rule'))}}">戻る</a>ストーリー「{{$rule->name}}」編集</div>
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="{{url('/bot/rule/edit')}}/{{$rule->botrule_id}}">
                    <h3>ボットルール名</h3>
                    <input class="form-control" name="name" id="name" type="text" value="{{ $rule->name }}" required> 
                    <p>ボットルールの名前を入れて下さい。</p>

                    <h3>ツイート間隔(分)</h3>
                    <input class="form-control" name="span" id="span" type="number" value="{{ $rule->span }}"　min="30" required> 
                    <p>ツイートの間隔を入力して下さい。</p>
                    <h3>ボットリミット設定</h3>
                    <input class="form-control" name="limit" id="limit" type="number" value="{{ $rule->limit }}" max="48" required> 
                    <p>一日の投稿数の制限を入力して下さい。</p>
                    <h3>ツイート時間設定</h3>
                    @for($i=0;$i < 24;$i++)
                    @if(in_array($i,explode(',',$rule->allowtime)))
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none;" checked="checked">
                    @else
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none";>
                    @endif
                    <label class="btn btn-default" for="allowtime-{{$i}}" style="width:60px;text-align:center;margin-bottom:10px;margin-right:5px;">{{$i}}</label>
                    @endfor

                    {{ csrf_field() }}
                    <p></p>
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>



            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
