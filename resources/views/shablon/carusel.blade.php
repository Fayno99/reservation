<!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="{{ asset('index.html')}}" class="navbar-brand p-0">
            <h1 class="m-0">  <img class="logo" src="{{ asset('img/logo.png')}}" alt="Image">    <i class="fas fa-biking-mountain me-2"></i>KingKustom</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ asset('/index')}}" class="nav-item nav-link active">Домашня</a>
                <a href="{{ asset('/master')}}" class="nav-item nav-link">Сервіс</a>
                <a href="{{ asset('/about')}}" class="nav-item nav-link">Про нас</a>
                <div class="nav-item dropdown">
                    <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Адмінка</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ asset('dayOff')}}"  class="dropdown-item">Вихідний Майстра</a>
                        <a href="{{ asset('schedules')}}"  class="dropdown-item">Графік робіт</a>
                    </div>
                </div>

            </div>
            <button type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
            <a href="https://htmlcodex.com/startup-company-website-template" class="btn btn-primary py-2 px-4 ms-3">Увійти</a>
        </div>
    </nav>

    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('img/carousel-1.jpg')}}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Креативні & Іноваційні</h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn">Краше рішення для ремонту вашого байку</h1>
                        <a href="/services" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Послуги</a>
                        <a href="/about" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Зв'язатися з нами</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('img/carousel-2.jpg')}}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Технологічні & Швидкі </h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn">Понад 10 років у ремонті мототехніки</h1>
                        <a href="{{ asset('/services')}}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Послуги</a>
                        <a href="{{ asset('/about')}}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Зв'язатися з нами</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Navbar & Carousel End -->
