  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <?php $currentUser=Auth::user() ?>
          <img src="{{$currentUser->gravatar()}}" class="img-circle" alt="{{$currentUser->name}}">
        </div>
        <div class="pull-left info">
          <p>{{$currentUser->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
          <a href="{{url('/home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pencil"></i>
            <span>Blog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('blog.index')}}"><i class="fa fa-circle-o"></i> All Posts</a></li>
            <li><a href="{{route('blog.create')}}"><i class="fa fa-circle-o"></i> Add New</a></li>
          </ul>
        </li>
        <li><a href="{{route('categories.index')}}"><i class="fa fa-folder"></i> <span>Categories</span></a></li>
        <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>