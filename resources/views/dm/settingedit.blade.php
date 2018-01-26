@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a href="{{url('/dm/setting')}}">戻る</a>
          {{$ac->account_id}} editpage
        </div>

        <div class="panel-body">


          <form action="{{url('/dm/setting')}}" method="post" class="form-horizontal">
           {{ csrf_field() }}
           <p>DMルール設定</p>
           <div class="form-group">
            <div class="col-md-8 col-md-offset-2">

              <select class="form-control" name="dmrule_id">
               <option value="0">送信しない</option>
               @foreach($rules as $r)
               <option value="{{ $r->dmrule_id }}" @if(old('dmrule_id') == $r->dmrule_id) selected @endif>{{$r->name}}</option>
               @endforeach
             </select>
           </div>
         </div>

         <p>DMストーリー設定</p>
         <div class="form-group">
           <div class="col-md-8 col-md-offset-2">
            <select class="form-control " name="dmstory_id">
              <option value="0">送信しない</option>
              @foreach($stories as $s)
              <option value="{{ $s->dmstory_id }}" @if(old('dmstory_id') == $s->dmstory_id) selected @endif>{{$s->name}}</option>
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
