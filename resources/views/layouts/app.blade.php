    @include('shablon.head')
    @vite([ 'resources/js/app.js'])


    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->

    @include('shablon.topbar')

<div class="black">

    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="{{ asset('index')}}" class="navbar-brand p-0">
                <h1 class="m-0">  <img class="logo" src="{{ asset('img/logo.png')}}" alt="Image">    <i class="fas fa-biking-mountain me-2"></i>KingKustom</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ asset('index')}}" class="nav-item nav-link">Домашня</a>
                    <a href="{{ asset('master')}}" class="nav-item nav-link">Сервіс</a>
                    <a href="{{ asset('about')}}" class="nav-item nav-link active">Про нас</a>

                    @include('shablon.UserDropdown')


           </div>
        </nav>


        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-dark-10 dark:bg-gray-90">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-dark  shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

    </body>

@include('shablon.downbar')
</div>
@include('shablon.js')
