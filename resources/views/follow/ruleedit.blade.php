@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
     <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="{{url('/follow/rule')}}">戻る</a>フォロールール編集</div>
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="{{url('/follow/rule')}}/{{$account->account_id}}">
                    <p>アカウント名：{{$account->screenname}}</p>


                    <p>フォロー間隔(分)</p>   
                    <input class="form-control" name="span" id="span" type="number" value="{{ $account->followrule->span }}" required> 
                    <p>1日のフォロー上限</p>
                    <input class="form-control" name="limit" id="limit" type="number" value="{{ $account->followrule->limit }}"  required> 
                    <p>フォローする時間帯</p>
                   @for($i=0;$i < 24;$i++)
                    @if(in_array($i,explode(',',$account->followrule->allowtime)))
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none;" checked="checked">
                    @else
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none";>
                    @endif
                    <label class="btn btn-default" for="allowtime-{{$i}}" style="width:60px;text-align:center;margin-bottom:10px;margin-right:5px;">{{$i}}</label>
                    @endfor
                    <p></p>
                    <input type="hidden" name="account_id" value="{{$account->account_id}}">

                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>



            </div>
        </div>
    </div>
</div>
</div>
@endsection
