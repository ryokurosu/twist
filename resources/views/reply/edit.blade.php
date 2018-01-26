@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
     <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="{{URL::previous()}}">戻る</a>アカウント名「{{$account->screenname}}」サンクスリプライ編集</div>
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="{{url('/reply/edit')}}/{{$account->account_id}}">


                    <h3>リプライ間隔(分)</h3>
                    <input class="form-control" name="span" id="span" type="number" value="{{ $account->thanksreply->span }}" min="0" required> 
                    <p>リプライを送る時間帯</p>
                    @for($i=0;$i < 24;$i++)
                    @if(in_array($i,explode(',',$account->thanksreply->allowtime)))
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none;" checked="checked">
                    @else
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none";>
                    @endif
                    <label class="btn btn-default" for="allowtime-{{$i}}" style="width:60px;text-align:center;margin-bottom:10px;margin-right:5px;">{{$i}}</label>
                    @endfor
                    <h3>リプライテキスト</h3>
                    <textarea class="form-control" name="text" id="text">{{$account->thanksreply->text}}</textarea>
                    <p>空欄にすると、何も送られません。</p>

                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>



            </div>
        </div>
    </div>
</div>
</div>
@endsection
