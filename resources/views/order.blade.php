@include('shablon.head')
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
            <a href="{{ asset('index') }}" class="navbar-brand p-0">
                <h1 class="m-0">  <img class="logo" src="{{ asset('img/logo.png')}}" alt="Image">    <i class="fas fa-biking-mountain me-2"></i>KingKustom</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ asset('index') }}" class="nav-item nav-link">Домашня</a>
                    <a href="{{ asset('master') }}" class="nav-item nav-link active">Сервіс</a>
                    <a href="{{ asset('about') }}" class="nav-item nav-link">Про нас</a>
                    @include('shablon.UserDropdown')


            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Час</h1>
                    <a href="{{ asset('index') }}" class="h5 text-white">Додому</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ asset('services') }}" class="h5 text-white">Сервіс</a>
                </div>
            </div>
        </div>
    </div>
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
      {{--    <!-- Quote Start -->--}}
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.05s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Ще трохи</h5>
                        <h1 class="mb-0">Залишилось дізнатись ваші персональні данні</h1>
                    </div>
                    <div class="row gx-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-4"><i class="fa fa-reply text-primary me-3"></i>Предзвонемо за 24 години</h5>
                        </div>
                    </div>
                    <p class="mb-4">В разі якихось додаткових питань ви можете зателефонувати нам за номером, щоб уточнити і підтвердити замовлення наш консультант зв'яжеться з вами, для покращення сервісу всі дзвінки записуються.</p>
                    <div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Телефон для зв'язку</h5>
                            <h4 class="text-primary mb-0">+80961791585</h4>
                        </div>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->isUser())
                    <div class="col-lg-5">
                        <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
                            <form action="{{ route('order.store') }}" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-xl-12">
                                        <h1 type="text" class="form-control bg-light border-0" name="name"  placeholder="{{ Auth::user()->name }}" style="height: 55px; font-size: 30px;">{{ Auth::user()->name }}</h1>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control bg-light border-0" rows="3" name="motorcycles" placeholder="Мапишіть свою марку мотоцикла"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" type="submit">Зробити замовлення послуги</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                <div class="col-lg-5">
                    <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
                        <form action="{{ route('order.store') }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-xl-12">
                                    <input type="text" class="form-control bg-light border-0" name="name"  placeholder="Ваше ім'я" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <input type="email" class="form-control bg-light border-0" name="email"  placeholder="Ваш Email" style="height: 55px;">
                                </div>
                                <div class="col-xl-12">
                                    <input type="text" class="form-control bg-light border-0" name="telephone" placeholder="Номер телефону" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control bg-light border-0" rows="3" name="motorcycles" placeholder="Мапишіть свою марку мотоцикла"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" type="submit">Зробити замовлення послуги</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Quote End -->
 @include('shablon.downbar')

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


@include('shablon.js')
