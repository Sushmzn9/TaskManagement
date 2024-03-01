<!doctype html>
<html lang="en">

<head>
    <title>Task Tracking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/sidebar/css/style.css')}}">
</head>

<body>

    <div id="modals"></div>

    <div class="wrapper d-flex align-items-stretch" id="app">
        <nav id="sidebar">
            <div class="p-4 pt-5">

                <ul class="list-unstyled components mb-5">
                    {{-- @can("admin") --}}
                    <li class="{{Request::is('departments/index', "users/index", "roles/index" , "permission/index", "tasks/index" )
                        ? "active" : "" }}">
                        <a href="#homeSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="{{Request::is('departments/index', " users/index", "roles/index"
                            , "permission/index","tasks/index" ) ? "true " : "false" }}" aria-controls="homeSubmenu">Management <i class="fa fa-angle-down float-right mt-2"></i></a>
                        <ul class=" collapse list-unstyled {{Request::is('departments/index', "users/index", "roles/index" , "permission/index" ) ? "show " : "" }}" id="homeSubmenu" id="homeSubmenu">
                            {{-- @can('departments-read') --}}
                            <li class="{{Request::is('departments/index')
                            ? " active" : "" }}">
                                <a href=" {{route('departments.index')}}">Departments</a>
                            </li>
                            {{-- @endcan --}}

                            {{-- @can('user-read') --}}
                            <li class="{{Request::is( " users/index") ? "active" : "" }}">
                                <a href="{{route('users.index')}}">Users</a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('roles-read') --}}
                            <li class="{{Request::is( " roles/index" ) ? "active" : "" }}">
                                <a href="{{route('roles.index')}}">Roles</a>
                            </li>
                            {{-- @endcan
                            @can('permissions-read') --}}
                            <li class="{{Request::is( " permission/index" ) ? "active" : "" }}">
                                <a href="{{route('permission.index')}}">Permission</a>
                            </li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('task-read') --}}
                    <li class="{{Request::is( "tasks/index" ) ? "active" : "" }}">
                        <a href="{{route('task.index')}}">Assign Tasks</a>
                    </li>
                    {{-- @endcan --}}
                    <li>
                        <a href="#"> Inbox</a>
                    </li>
                </ul>

                <div class="footer">

                    Copyright &copy;

                    All rights reserved
                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" id="navbarCollapse">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{route('logout')}}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @if($errors->any)
            @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
            @endforeach
            @endif
            @if(Session::has('success'))
            <p class="text-success">
                {{Session::get('success')}}
            </p>
            @endif

            @yield('content')

        </div>
    </div>

    <!--
    @auth
    <script>
        window.token = {
            !!json_encode(session() - > get('token')) !!
        };
        window.auth_roles = {
            !!json_encode(auth() - > user() - > roles) !!
        };
        window.auth_permissions = {
            !!json_encode(auth() - > user() - > permissions) !!
        };
    </script>




    @endauth -->




    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/sidebar/js/main.js') }}"></script>


</body>

</html>