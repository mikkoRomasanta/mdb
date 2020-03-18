<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nerds') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/datatables.css')}}"/>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/flexdatalist/jquery.flexdatalist.min.css') }}" type="text/css">

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables/datatables.js')}}"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.1/js/dataTables.fixedColumns.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/flexdatalist/jquery.flexdatalist.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>
<body>
    @if(Auth::guest())
        @include('auth.login')
    @else
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'NERDS') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        @if(Auth::guest())
                        @elseif(Auth::user()->role == 'ADMIN')
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-link">
                                        <a class="nav-link" href="{{ route('employees') }}">Employees</a>
                                    </li>
                                    <li class="nav-link">
                                        <a class="nav-link" href="{{ route('apps.index') }}">App List</a>
                                    </li>
                                    <li class="nav-link">
                                        <a class="nav-link" href="{{ route('organization') }}">Organization</a>
                                    </li>
                                </ul>
                        @endif

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                {{-- @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif --}}
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->emp_id }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="change-password">Change Password</a>
                                        <hr>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @include('layouts.flash-messages')
                @yield('content')
                @yield('modal')
            </main>
        </div>

        @stack('scripts')
    @endif
    </body>
</html>