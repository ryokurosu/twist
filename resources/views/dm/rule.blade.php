@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">DMルール追加</div>
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="{{url('/dm/rule')}}">
                    <p>DMルール名</p>
                    <input class="form-control" name="name" id="name" type="text" value="{{ old('name','Default Name') }}" required> 
                    <p>DM間隔(分)</p>
                    <input class="form-control" name="span" id="span" type="text" value="{{ old('span','1') }}" min="0" required> 
                    <p>フォローされてからDMまで最短時間(時間)</p>
                    <input class="form-control" name="response" id="response" type="text" value="{{ old('response','6') }}" min="0" required> 
                    <p>1日のDM上限数</p>
                    <input class="form-control" name="limit" id="limit" type="text" value="{{ old('limit','100') }}" max="1000" required>
                    <p>DMを送る時間帯</p>
                    @for($i=0;$i < 24;$i++)
                    @if(in_array($i,[9,10,11,12,13,14,15,16,17,18,19,20,21]))
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none;" checked="checked">
                    @else 
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none;">
                    @endif
                    <label class="btn btn-default" for="allowtime-{{$i}}" style="width:60px;text-align:center;margin-bottom:10px;margin-right:5px;">{{$i}}</label>
                    @endfor
                    <p></p>
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">作成</button>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">DMルール一覧</div>
            <div class="panel-body">

                <table class="table">
                 <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Span</th>
                    <th scope="col">Limit</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            @foreach($rules as $rule)
            <tr style="height:50px">
               <th scope="row">{{$rule->dmrule_id}}</th>
               <td>{{$rule->name}}</td>
               <td>{{$rule->span}}</td>
               <td>{{$rule->limit}}</td>
               <td><a class="btn btn-primary" href="{{url('/dm/rule/edit')}}/{{$rule->dmrule_id}}">Edit</a></td>
               <td><a class="btn btn-danger" href="{{url('/dm/rule/delete')}}/{{$rule->dmrule_id}}" onclick="return confirm('本当に削除していいですか？')">Delete</a></td>
           </tr>
           @endforeach
       </table>
   </div>

</div>
</div>
</div>

</div>
</div>
@endsection
