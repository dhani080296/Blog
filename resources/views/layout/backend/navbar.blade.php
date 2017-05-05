 <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MY</b>BLOG</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a> -->
@if(!Auth::guest())
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
          <?php $currentUser= Auth::user() ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{$currentUser->gravatar()}}" class="user-image" alt="{{$currentUser->name}}">
              <span class="hidden-xs">{{$currentUser->name}}</span>
            </a>
            <ul class="dropdown-menu">
             <li class="user-header">
                <img src="{{$currentUser->gravatar()}}" class="img-circle" alt="{{$currentUser->name}}">

                <p>
                  {{$currentUser->name}} - Web Developer
                  
                </p>
              </li>
              <!-- User image -->
              <li class="user-footer">
              <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
              <div class="pull-right">
      <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" 
       onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"> Logout </a>
 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>
</div></li>
                              
              <!-- Menu Footer-->
              
             
            </ul>
          </li>
        </ul>
      </div>
       @endif
    </nav>
  </header>