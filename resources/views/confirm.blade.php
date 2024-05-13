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
            <a href="{{ asset('index.html') }}" class="navbar-brand p-0">
                <h1 class="m-0">  <img class="logo" src="{{ asset('img/logo.png')}}" alt="Image">    <i class="fas fa-biking-mountain me-2"></i>KingKustom</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ asset('index') }}" class="nav-item nav-link">Домашня</a>
                    <a href="{{ asset('master') }}" class="nav-item nav-link">Сервіс</a>
                    <a href="{{ asset('about') }}" class="nav-item nav-link">Про нас</a>
                    @include('shablon.UserDropdown')


            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Заявка</h1>
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
    @if(Session::has('success'))
    @endif  <!-- Full Screen Search End -->
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.05s">
            <div class="container py-5">
                <div class="row g-5">


                    @foreach($work_order as $order)
                        <div class="alert alert-success">
                            <h1 class="mb-3">  {{ Session::get('success') }}</h1>
                            <div class="alert alert-success" data-wow-delay="0.6s">
                                <h4 class="mb-3">Компанія: {{$order->companies->name}}</h4>
                                <h3 class="mb-3">Ім'я механіка: {{$order->master->name}}</h3>
                                <h3 class="mb-3">Вид роботи: {{$order->work->name_of_work}} </h3>
                                <h3 class="mb-3">Ціна: {{$order->work->price}} </h3>
                                <h3 class="mb-3">Тип мотоциклу: {{$order->motorcycles}} </h3>
                                <h3 class="mb-3">Початок замовлення: {{$order->start_order}} </h3>
                                <h3 class="mb-3">Кінець замовлення:  {{$order->stop_order}} </h3>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>



<!-- Quote End -->
@include('shablon.downbar')

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
