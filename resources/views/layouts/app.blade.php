<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/twitter-text.js') }}"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                        <li>
                            <a href="{{url('/account/manage')}}">登録アカウント数：{{Auth::user()->accountcount}}</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @if(Auth::id() == 1)
                            <li><a href="{{url('/admin')}}">ユーザー一覧</a></li>
                            <li><a href="{{url('/register')}}">ユーザー追加</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <ul class="nav nav-pills">
             <li class="nav-item">
                <a class="nav-link" href="{{url('/api')}}">API設定</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">アカウント</a>
                <div class="dropdown-menu">
                    <ul>
                     <li><a class="dropdown-item" href="{{url('/account/register')}}">アカウント登録・更新</a></li>
                     <li><a class="dropdown-item" href="{{url('/account/manage')}}">アカウント管理</a></li>
                     <li><a class="dropdown-item" href="{{url('/account/csv')}}">CSVアカウント一括登録</a></li>
                     <li><a class="dropdown-item" href="{{url('/account/statistic')}}">統計情報</a></li>
                 </ul>
             </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ボット</a>
            <div class="dropdown-menu">
                <ul>
                  <li><a class="dropdown-item" href="{{url('/bot/story')}}">ボットストーリー管理</a></li>
                  <li><a class="dropdown-item" href="{{url('/bot/rule')}}">ボットルール管理</a></li>
                  <li><a class="dropdown-item" href="{{url('/bot/setting')}}">ボット設定</a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">自動フォロー</a>
        <div class="dropdown-menu">
            <ul>
                <li><a class="dropdown-item" href="{{url('/follow/rule')}}">フォロールール管理</a></li>
                <li><a class="dropdown-item" href="{{url('/follow/target')}}">フォロー先管理</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/unfollow')}}">アンフォロールール管理</a>
    </li>
    <!--  <li class="nav-item">
        <a class="nav-link" href="{{url('/like')}}">自動いいね</a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('/reply')}}">サンクスリプライ</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">サンクスDM</a>
        <div class="dropdown-menu">
            <ul>
                <li><a class="dropdown-item" href="{{url('/dm/rule')}}">DMルール管理</a></li>
                <li><a class="dropdown-item" href="{{url('/dm/story')}}">DM文章セット管理</a></li>
                <li><a class="dropdown-item" href="{{url('/dm/setting')}}">自動DM設定</a></li>
            </ul>
        </div>
    </li>
</ul>
</div>
</nav>



@yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
