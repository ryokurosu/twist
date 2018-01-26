@extends('layouts.app')

@section('content')
<div class="container">

 <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">CSV一括アカウント登録</div>
            <div class="panel-body">
                <form method="POST" action="{{ url('/account/csv') }}" enctype="multipart/form-data">
                  <input type="file" name="data_file">
                  {{ csrf_field() }}
                  <button class="btn btn-primary" type="submit">Upload</button>
              </form>

          </div>
      </div>
  </div>
</div>
</div>
@endsection
