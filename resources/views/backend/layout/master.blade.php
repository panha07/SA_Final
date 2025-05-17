<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>First Solutions Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo/logo.png') }}">
    <!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    @include('backend.layout.css')

    <!-- Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <!-- Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">

            @include('backend.layout.left_Side')
            <!-- End Sidebar scroll-->
        </aside>
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                @include('backend.layout.header')
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="row">
                    <hr />
                    <br>
                    @yield('backend_content')
                    {{-- @include("backend.layout.footer") --}}

                </div>

            </div>
        </div>
    </div>
    @include('backend.layout.js')
</body>

</html>
