<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('athelete.dashboard')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Athelete</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('athelete.dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{route('athelete.dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('team') ? 'active' : '' }}">
        <a class="nav-link active" href="{{route('team')}}">
            <i class="fas fa-cog"></i>
            <span>Teams</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('searchcollege.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('searchcollege.index') }}">
            <i class="fas fa-search"></i>
            <span>Search College</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('user_profile.index') ? 'active' : '' }}">
        <a class="nav-link active" href="{{route('user_profile.index')}}">
            <i class="fas fa-cog"></i>
            <span>Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/logout')}}">
            <i class="fas fa-cog"></i>
            <span>Logout</span></a>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
