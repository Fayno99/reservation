@include("shablon.head")

<body>
<!-- Spinner Start -->
<div id="spinner"
     class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner"></div>
</div>
<!-- Spinner End -->


@include('shablon.topbar')
<div class="black">
    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="{{ asset('index') }}" class="navbar-brand p-0">
                <h1 class="m-0"><img class="logo" src="{{ asset('img/logo.png')}}" alt="Image"> <i
                        class="fas fa-biking-mountain me-2"></i>KingKustom</h1>
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
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3"
                               placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->
    <br>
    <br>
    <br>
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-10">
                </div>
                <div class="col-lg-26 wow slideInUp">
                    <div class="row g-23">
                        <form action="{{ route('work.update', $work->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="name_of_work" style="height: 55px;"
                                               name="name_of_work" value="{{ $work->name_of_work }}">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="name_of_work" style="height: 55px;"
                                               name="description" value="{{ $work->description }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" id="name_of_work" style="height: 55px;"
                                               name="price" value="{{ $work->price }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" id="name_of_work" style="height: 55px;"
                                               name="time_for_work" value="{{ $work->time_for_work }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="activeButton" onclick="toggleValue()"
                                                @if($work->active === 1) style="background-color: green; border: #0a283f;border-radius: 5px;height: 55px"
                                                @else style="background-color: red; border: #0a283f;border-radius: 5px;height: 55px" @endif>
                                            @if($work->active === 1)
                                                Активна
                                            @else
                                                Не Активна
                                            @endif
                                        </button>
                                        <input type="hidden" id="active" name="active" value="{{ $work->active }}">
                                    </div>

                                    <script>
                                        function toggleValue() {
                                            const activeInput = document.getElementById("active");
                                            const activeButton = document.getElementById("activeButton");

                                            if (activeInput.value === "0") {
                                                activeInput.value = "1";
                                                activeButton.textContent = "Активна";
                                                activeButton.style.backgroundColor = "green";
                                            } else {
                                                activeInput.value = "0";
                                                activeButton.textContent = "Не Активна";
                                                activeButton.style.backgroundColor = "red";
                                            }
                                        }
                                    </script>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Зберегти</button>
                            </div>
                        </form>
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

