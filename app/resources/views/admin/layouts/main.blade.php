<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include('admin.includes.navbar')
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
        @include('admin.includes.topbar',['ticket'=>$menuTicket])
        <!-- End of Topbar -->
            @section('breadcrumbs', Breadcrumbs::render())
            @yield('breadcrumbs')
            <div class="container-fluid">
                <!-- Begin Page Content -->
                @yield('content')
            <!-- /.container-fluid -->
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
    @include('admin.includes.footer')
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="{{ mix('js/app.js', 'build') }}"></script>

</body>

</html>