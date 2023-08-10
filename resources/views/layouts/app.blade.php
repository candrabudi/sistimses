@include('layouts.styles')
<body>
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">

            @include('layouts.navbar')

            <div class="layout-page">

                <div class="content-wrapper">

                    @include('layouts.aside')

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    @include('layouts.footer')
                    <div class="content-backdrop fade"></div>
                </div>

            </div>

        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
    @include('layouts.scripts')
</body>

</html>