<!doctype html>
<html lang="en">
  <head>
    @include('_head')

    @yield('stylesheets')

  </head>

    <body>

      @include('_nav')

        <!-- Default bootstrap Navbar -->

      
      <div class="container">
          
          @include('_messages')

          @yield('content')
        
          @include('_footer')

      </div> <!-- end of the container --> 

      @include('_javascript')

      @yield('scripts')
    
    </body>
  
</html>