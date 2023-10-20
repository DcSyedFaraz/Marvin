<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('athelete.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <?php $roles = Auth()
                ->user()
                ->getRoleNames(); ?>
            <label class="">{{ str_replace('_', ' ', $roles[0]) }}</label>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('coach.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('coach.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('coach.dashboard') }}">
            <i class="fas fa-cog"></i>
            <span>Teams</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('colleges.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('colleges.dashboard') }}">
            <i class="fas fa-cog"></i>
            <span>Colleges</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('manage-players.index') ? 'active' : '' }}">
        <a class="nav-link collapsed {{ request()->routeIs('manage-players.index') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
          <i class="fas fa-sitemap"></i>
          <span>Player's Manage</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Player's Manage:</h6>
            <a class="collapse-item {{ request()->routeIs('manage-players') ? 'active' : '' }}" href="{{ route('manage-players.index') }}">Player's Manage</a>
            <a class="collapse-item" href="{{route('manage-players.create')}}">Add Player </a>
          </div>
        </div>
        <li class="nav-item {{ request()->routeIs('posts.index') ? 'active' : '' }}">
            <a class="nav-link " href="{{ route('posts.index') }}">
              <i class="fas fa-feather"></i>
              <span>Posts</span>
            </a>
          </li>



    </li>
    {{-- <li class="nav-item">
        <a class="nav-link nav-dropdown-toggle "
            href="#">
            <i class="fas fa-cog"></i>
            <span>Player's Manage </span></a>
        <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href=""
                    class="nav-link {{ request()->routeIs('manage-players') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Player's Manage</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('#') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Users</p>
                </a>
            </li>

        </ul>
    </li> --}}
    <li class="nav-item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('profile.index') }}">
            <i class="fas fa-cog"></i>
            <span>Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/logout') }}">
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
