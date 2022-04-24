    <!-- Default bootstrap Navbar -->

    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Laravel Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home <span class="sr-only">(current)</span></a></li>
            <li class="{{ Request::is('contact') ? 'active' : '' }}"> <a href="contact ">Contact</a> </li>
            <li><a href="{{ route('posts.index') }}">All Posts</a></li>
            <li><a href="{{ route('posts.create') }}">Create New Post</a></li>
            <li><a href="{{ route('categories.index') }}"> Categories</a></li>
            <li><a href="{{ route('tags.index') }}"> Tags</a></li>
            <li><a href="{{ route('auth.register') }}">Register</a></li>
            <li ><a href="{{ route('auth.login') }}">Login</a></li>
          @auth
          <li> <a href="{{ route('auth.logout') }}">Logout</a>  </li>
          @endauth
           
        </ul>
        <ul class="nav navbar-nav navbar-right">
          @if (Auth::check())
        <li class="nav-item dropdown">
          <a  href="#" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" haspopup="true" aria-expanded="false">
            Hello {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>

        @else 
        
       <li> <a href="{{ route('auth.login') }}"> Login</a> </li>

        @endif
        </ul>

          </div>
        </div>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
    
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
