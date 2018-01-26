@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">ボットルール追加</div>
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="{{url('/bot/rule')}}">
                    <p>ボットルール名</p>
                    <input class="form-control" name="name" id="name" type="text" value="{{ old('name','Default Name') }}" required> 
                    <p>ツイート間隔(分)</p>
                    <input class="form-control" name="span" id="span" type="number" value="{{ old('span',30) }}" min="30" required> 
                    <p>1日のツイート上限数</p>
                    <input class="form-control" name="botlimit" id="botlimit" type="number" value="{{ old('botlimit',48) }}" max="48" required> 
                    {{ csrf_field() }}
                    <p>ツイート時間帯</p>
                    @for($i=0;$i < 24;$i++)
                    @if(in_array($i,[9,10,11,12,13,14,15,16,17,18,19,20,21]))
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none;" checked="checked">
                    @else 
                    <input type="checkbox" name="allowtime[]" id="allowtime-{{$i}}" value="{{$i}}" style="display:none;">
                    @endif
                    <label class="btn btn-default" for="allowtime-{{$i}}" style="width:60px;text-align:center;margin-bottom:10px;margin-right:5px;">{{$i}}</label>
                    @endfor
                    <p></p>

                    <button class="btn btn-primary" type="submit">作成</button>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">ボットルール一覧</div>
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
                @foreach($botrules as $rule)
                <tr style="height:50px">
                 <th scope="row">{{$rule->botrule_id}}</th>
                 <td>{{$rule->name}}</td>
                 <td>{{$rule->span}}</td>
                 <td>{{$rule->botlimit}}</td>
                 <td><a class="btn btn-primary" href="{{url('/bot/rule/edit')}}/{{$rule->botrule_id}}">Edit</a></td>
                 <td><a class="btn btn-danger" href="{{url('/bot/rule/delete')}}/{{$rule->botrule_id}}" onclick="return confirm('本当に削除していいですか？')">Delete</a></td>
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
