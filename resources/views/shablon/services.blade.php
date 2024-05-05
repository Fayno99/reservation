<!-- Service Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Наші сервіси</h5>
            <h1 class="mb-0">Кращі рішення для швидкого і якісного ремонту</h1>
        </div>
        <div class="row g-5">
                 @foreach($serviceList as $service)
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-search text-white"></i>
                    </div>
                    <h4 class="mb-3">{{$service->name_of_work}}</h4>
                    <p class="mb-3">{{$service->description}}</p>
                    <a class="btn btn-lg btn-primary rounded" href="/master">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                    <h3 class="text-white mb-3">Зателефонуйте за більш детальною інформацією</h3>
                    <h2 class="text-white mb-0">+380961791585</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->
