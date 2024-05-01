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
                <a href="{{ asset('/index')}}" class="nav-item nav-link active">Домашня</a>
                <a href="{{ asset('/master')}}" class="nav-item nav-link">Сервіс</a>
                <a href="{{ asset('/about')}}" class="nav-item nav-link">Про нас</a>
                <a href="{{ asset('/DayOff')}}" class="nav-item nav-link">Вихідний Майстра</a>
                <a href="{{ asset('/price')}}" class="nav-item nav-link">Ціни</a>

            </div>
            <button type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
            <a href="https://htmlcodex.com/startup-company-website-template" class="btn btn-primary py-2 px-4 ms-3">Увійти</a>
        </div>
    </nav>

</div>
<!-- Navbar End -->
