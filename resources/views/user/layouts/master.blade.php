<!DOCTYPE html>
<html lang="en">
<!-- DataTables -->
@include('user.layouts.head')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('user.layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('user.layouts.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('main-content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('user.layouts.footer')
            <!-- DataTables  & Plugins -->
            <script src="{{ asset('/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/jszip/jszip.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
            <script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
            <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
            <script src="https://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>

            <!-- End of Main Content -->
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
            <!-- Toastr -->
            <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
            @yield('scripts')

            <script>
                $(document).ready(function() {
                    // alert('asd');
                    $('#example1').dataTable({
                        "pagingType": "full_numbers",
                        "paging": true,
                    })
                });
                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @endif
                @if (session('warning'))
                    toastr.warning("{{ session('warning') }}")
                @endif
                @if (session('info'))
                    toastr.info("{{ session('info') }}")
                @endif
                @if (session('error'))
                    toastr.error("{{ session('error') }}")
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}")
                    @endforeach
                @endif
            </script>
</body>

</html>
