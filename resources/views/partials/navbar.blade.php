<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">{{env('SPACE_NAME')}}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{url('/')}}" class="">Home</a></li>
                <li><a href="{{url('user')}}" class="">Members</a></li>
                <li><a href="{{url('perm')}}" class="">Permissions</a></li>
                @if(Auth::check() && Auth::User()->is('admin'))
                    <li><a href="{{url('admin')}}" class="">Admin</a></li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Documentation<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('docs/permissions')}}">Permissions</a></li>
                        <li><a href="{{url('docs/transactions')}}">Transactions</a></li>
                        <li><a href="{{url('docs/api')}}">API</a></li>

                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">

                @if(Auth::guest())
                    <li><a href="{{url('/auth/login')}}">Login</a></li>
                    <li><a href="{{url('/auth/register')}}">Register</a></li>
                @endif

                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/auth/logout')}}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>