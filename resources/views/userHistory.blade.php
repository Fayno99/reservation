@include("shablon.head")

<body>
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
            <a href="{{ asset('index.html') }}" class="navbar-brand p-0">
                <h1 class="m-0">  <img class="logo" src="{{ asset('img/logo.png')}}" alt="Image">    <i class="fas fa-biking-mountain me-2"></i>KingKustom</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ asset('index') }}" class="nav-item nav-link">Домашня</a>
                    <a href="{{ asset('master') }}" class="nav-item nav-link ">Сервіс</a>
                    <a href="{{ asset('about') }}" class="nav-item nav-link">Про нас</a>
                    @include('shablon.UserDropdown')

                </div>
        </nav>

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Графік вихідних майстрів</h1>
                    <a href="{{ asset('index') }}" class="h5 text-white">Додому</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ asset('services') }}" class="h5 text-white">Сервіс</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->




    <!-- Navbar End -->

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->

        <!-- Contact End -->
        <div class="container-fluid facts py-5 pt-lg-0">
            <div class="container py-5 pt-lg-0">
                <div class="row gx-0">
                    <div class="col-10">
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="h1 text-white">  Компанія  </th>
                            <th class="h1 text-white"> Майстер  </th>
                            <th class="h1 text-white"> Мотоцикл  </th>
                            <th class="h1 text-white"> Вид робіт  </th>
                            <th class="h1 text-white"> Початок робіт  </th>
                            <th class="h1 text-white"> Кінець побіт  </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($historyList as $history)
                        <tr>
                            <td class="h1 text-primary mb-4" >{{ $history->companies->name }}</td>
                            <td class="h1 text-primary mb-4">{{ $history->master->name }}</td>
                            <td class="h1 text-primary mb-4">{{ $history['motorcycles'] }}</td>
                            <td class="h1 text-primary mb-4">{{ $history->work->name_of_work }}</td>
                            <td class="h1 text-primary mb-4">{{ $history['start_order'] }}</td>
                            <td class="h1 text-primary mb-4">{{ $history['stop_order'] }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

    </div>







    @include('shablon.downbar')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

</div>
<body>

@include('shablon.js')

