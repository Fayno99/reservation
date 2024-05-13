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
                    <h1 class="display-4 text-white animated zoomIn">Адмін панель</h1>
                    <a href="{{ asset('adminDashboard') }}" class="h5 text-white">Статистика</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ asset('admin') }}" class="h5 text-white">Користувачі</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ asset('adminListOfWork') }}" class="h5 text-white">Змінити вид робіт</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ asset('adminWorker') }}" class="h5 text-white">Додати працівника</a>
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




    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-10">

                    <div class="col-lg-16 wow slideInUp" >
                        <div class="row g-13">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="container">
                                <div class="jumbotron">
                                    <h3 class="text-center">Edit Master</h3>
                                </div>
                                <form action="{{ route('adminWorkerUpdate', $master->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" style="height: 55px;" value="{{ $master->name }}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="file" name="image" class="form-control" style="height: 55px;" >
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-center position-relative  mb-5 mx-auto">
                                                <select id="SelectWorkers" class="form-select" name="companies_id" style="height: 55px;">
                                                    <option>{{ $master->company }}</option>
                                                    @foreach($companies as $company)
                                                        <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" style="height: 55px;" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('adminWorker')}}" class="btn btn-primary py-2 px-4 ms-3">Назад</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>




                </div>
            </div>
        </div>








        @include('shablon.downbar')

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    </div>
    <body>

    @include('shablon.js')

