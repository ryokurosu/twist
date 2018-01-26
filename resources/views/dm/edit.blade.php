@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
       <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{url('/dm/rule')}}">戻る</a>
                ルール「{{$rule->name}}」編集
            </div>
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="{{url('/dm/rule/edit')}}/{{$rule->dmrule_id}}">

                    <h3>DMルール名</h3>
                    <input class="form-control" name="name" id="name" type="text" value="{{$rule->name}}" required> 
                    <h3>DM感覚(分)</h3>
                    <input class="form-control" name="span" id="span" type="number" value="{{ $rule->span }}" min="0" required> 
                    <p>DMの間隔を入力して下さい。</p>
                    <p>フォローされてからDMまで最短時間(時間)</p>
                    <input class="form-control" name="response" id="response" type="text" value="{{ $rule->response }}" min="0" required> 
                    <h3>1日のDM上限数</h3>
                    <input class="form-control" name="limit" id="limit" type="number" value="{{ $rule->limit }}"  max="1000" required> 
                    <p>一日のDM数の制限を入力して下さい。</p>
                    <p>DMを送る時間帯</p>
                    @for($i=0;$i < 24;$i++)
                    @if(in_array($i,explode(',',$rule->allowtime)))
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none;" checked="checked">
                    @else
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none";>
                    @endif
                    <label class="btn btn-default" for="allowtime-{{$i}}" style="width:60px;text-align:center;margin-bottom:10px;margin-right:5px;">{{$i}}</label>
                    @endfor
                    <p></p>
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>



            </div>
        </div>
    </div>
</div>
</div>
@endsection
