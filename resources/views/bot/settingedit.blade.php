@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a href="{{url('/bot/setting')}}">戻る</a>
          {{$ac->screenname}} ボット設定
        </div>

        <div class="panel-body">


          <form action="{{url('/bot/setting')}}" method="post" class="form-horizontal">
           {{ csrf_field() }}
           <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
              <p>ボットルール設定</p>
              <select class="form-control" name="botrule_id">
                <option value="0">送信しない</option>
                @foreach($rules as $r)
                <option value="{{ $r->botrule_id }}" @if(old('botrule_id') == $r->botrule_id) selected @endif>{{$r->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
              <p>ボットストーリー設定</p>
              <select class="form-control" name="botstory_id">
                <option value="0">送信しない</option>
                @foreach($stories as $s)
                <option value="{{ $s->botstory_id }}" @if(old('botstory_id') == $s->botstory_id) selected @endif>{{$s->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <input type="hidden" name="account_id" value="{{$ac->account_id}}">
          <div class="container">

            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
</div>

</div>
@endsection
