@include('admin.header')

<body>
    @include('admin.sidebar')
    <div class="main" style="margin-left:220px;">
        @include('admin.navbar')

        <div class="container-fluid p-4 content-wrapper">
            @yield('content')
        </div>

        @include('admin.footer')
    </div>
</body>

@if (session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

</html>
