<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route((auth()->user()->role == 'admin') ? 'admin.dashboard' : 'vendor.dashboard' ) }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{ route((auth()->user()->role == 'admin') ? 'admin.dashboard' : 'vendor.dashboard' ) }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>


    @if(Auth::user()->role == 'admin')



    <hr class="sidebar-divider">


     <!-- Heading -->
    <div class="sidebar-heading">
        Generals
    </div>

     <!-- Users -->
     <li class="nav-item {{ request()->routeIs('college.*')? 'active' : '' }}">
        <a class="nav-link" href="{{route('college.index')}}">
          <i class="fas fa-university"></i>
          <span>Colleges</span>
        </a>
    </li>
     <li class="nav-item {{ request()->routeIs(['coach.data','data.*'])? 'active' : '' }}">
        <a class="nav-link " href="{{route('coach.data')}}">
          <i class="fas fa-graduation-cap"></i>
          <span>Coaches Data</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('sport.*')? 'active' : '' }}">
        <a class="nav-link" href="{{route('sport.index')}}">
          <i class="fas fa-users"></i>
          <span>Sports</span>
        </a>
    </li>

     <li class="nav-item {{ request()->routeIs('users.*')? 'active' : '' }}">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
    </li>
     {{-- <li class="nav-item {{ request()->routeIs('college.*')? 'active' : '' }}">
        <a class="nav-link" href="{{route('roles.index')}}">
            <i class="fas fa-users"></i>
            <span>Roles</span></a>
    </li> --}}
     {{-- <li class="nav-item ">
        <a class="nav-link" href="{{route('permission.index')}}">
            <i class="fas fa-users"></i>
            <span>Permissions</span></a>
    </li> --}}
     <li class="nav-item {{ request()->routeIs('teams.*')? 'active' : '' }}">
        <a class="nav-link" href="{{route('teams.index')}}">
            <i class="fas fa-users"></i>
            <span>Teams</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('post.*')? 'active' : '' }}">
        <a class="nav-link" href="{{ route('post.index') }}">
          <i class="fas fa-feather"></i>
          <span>Posts</span>
        </a>
      </li>
     <!-- General settings -->
     <li class="nav-item {{ request()->routeIs('settings')? 'active' : '' }}">
        <a class="nav-link" href="{{route('settings')}}">
            <i class="fas fa-cog"></i>
            <span>Settings</span></a>
    </li>
     <li class="nav-item {{ request()->routeIs('profile.*')? 'active' : '' }}">
        <a class="nav-link" href="{{route('profile.index')}}">
            <i class="fas fa-cog"></i>
            <span>Profile</span></a>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="{{url('/logout')}}">
            <i class="fas fa-cog"></i>
            <span>Logout</span></a>
    </li>

  @endif



    <!-- Divider -->


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
