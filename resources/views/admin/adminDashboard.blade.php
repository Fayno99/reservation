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

    <form action="{{ route('sumPriceTotal') }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div style="font-size:26px; color:#a1d2dd;"  > Діапазон відображення від {{ $start_date->format('Y-m-d') }} до {{ $end_date->format('Y-m-d') }}</div>
        <input type="date" id="myDateStart" name="myStartDate" style="font-size:26px;" value="{{ $start_date->format('Y-m-d') }}">
        <input type="date" id="myDateEnd" name="myStopDate" style="font-size:26px;" value="{{ $end_date->format('Y-m-d') }}">
        <button type="submit" class="btn btn-primary py-2 px-4 ms-3">Змінити</button>
    </form>
       <div class="container1" style=" text-align:center;">
        <div class="block1" style="font-size:26px; color:#a1d2dd;"  >Грошей /грн
            <div style="font-size:86px; color:#02fb59;padding-top: 0.4em;" > {{$totalPrise}}</div>
        </div>
        <div class="block1"  style="font-size:26px; color:#a1d2dd;text-align:center;"  >Робочих годин /год
            <div  style="font-size:86px; color:#02fb59;padding-top: 0.4em;"> {{$totalHouers}}</div>
        </div>
        <div class="block1" style="font-size:26px; color:#a1d2dd;"  >Робочих днів по працівникам
            @foreach( $totalWorkDayWorkers as $workDayWorkers =>$days)
           <div  style="  line-height: 0.05em;">
               <div class="block1" style="font-size:36px; color:#0d937f; ">{{$workDayWorkers}} </div>
               <div class="block1" style="font-size:36px; color:#fbc002; ">  {{$days}} </div>
           </div>
            @endforeach
        </div>
    </div>

    <div class="container1">


                    <div class="block2 text-primary "  style="font-size:26px;">Грошей по дням
                        <canvas id="myChart"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: {!! json_encode(array_keys($dailyTotalsByMoney->toArray())) !!},
                                    datasets: [{
                                        label: 'Daily Totals',
                                        data: {!! json_encode(array_values($dailyTotalsByMoney->toArray())) !!},
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>

                    <div class="block2 text-primary "  style="font-size:26px;"  >Робочих годин по дням
                        <canvas id="myChart2"></canvas>
                        <script>
                            var ctx = document.getElementById('myChart2').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: {!! json_encode(array_keys($dailyTotalsByTime->toArray())) !!},
                                    datasets: [{
                                        label: 'Daily Totals',
                                        data: {!! json_encode(array_values($dailyTotalsByTime->toArray())) !!},
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>

    </div>


    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-10">
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

