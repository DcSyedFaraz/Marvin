<!DOCTYPE html>
<html lang="en">

@include('coach.layouts.head')

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('coach.layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('coach.layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @include('coach.layouts.notification')
        @yield('main-content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      @include('coach.layouts.footer')

</body>

</html>
