    @include('manage.public.header')

    @include('manage.public.menu')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @include('manage.public.footer')

</div>
<!-- ./wrapper -->


</body>
</html>
