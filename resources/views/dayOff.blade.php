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
                <a href="{{ asset('index') }}" class="navbar-brand p-0">
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

    <!-- Contact Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
                         <div class="text-center position-relative pb-3 mb-5 mx-auto" >
                            <div class="modal-body d-flex align-items-center justify-content-center">
                                   <div class="text-center position-relative  mb-5 mx-auto">
                                    <h1 class="mb-0">Вказати вихідний</h1>
                                       <label for="myDate">Оберіть початок вихідного</label>
                                       <input type="date" id="myDate" name="myDate">
                                   </div>
                                <div class="text-center position-relative  mb-5 mx-auto">
                                    <select id="SelectWorkers" class="form-select">
                                        <option>Оберіть робітника</option>
                                        @foreach($Masters as $Master)
                                            <option value="{{ $Master['id'] }}">{{ $Master['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="navbar-brand p-0">

                                </div>
                                <div class="text-center position-relative  mb-5 mx-auto">
                                    <select id="SelectedDays" class="form-select">
                                        <option selected class="mb-3">Оберіть кількість вихідних</option>
                                        <option value="0">1</option>
                                        <option value="1">2</option>
                                        <option value="2">3</option>
                                        <option value="3">4</option>
                                        <option value="4">5</option>
                                        <option value="5">6</option>
                                        <option value="6">7</option>
                                        <option value="7">8</option>
                                        <option value="8">9</option>
                                        <option value="9">10</option>
                                        <option value="10">11</option>
                                        <option value="11">12</option>
                                        <option value="12">13</option>
                                        <option value="13">14</option>
                                    </select>
                                </div>
                                <div class="navbar-brand p-0">
                                    <div class="text-center position-relative  mb-5 mx-auto">
                                        <a href="#" id="createDayOffButton" class="btn btn-primary py-2 px-4 ms-3" onclick="function redirectToDayOff() {

                                                        const selectedDate = document.getElementById('myDate').value;
                                                        const selectedDays = document.getElementById('SelectedDays').value;
                                                        const selectedMasterId = document.getElementById('SelectWorkers').value;
                                                        const dayOffUrl = `dayOff/${selectedDate}/${selectedMasterId}/${selectedDays}`;
                                                        window.location.href = dayOffUrl;
                                                                                            }
                                        redirectToDayOff()">Створити Вихідний</a>
                                    </div>
                                </div>
                            </div>
                         </div>
                     </div>
    <!-- Contact End -->
        <div class="container-fluid facts py-5 pt-lg-0">
                <div class="container py-5 pt-lg-0">
                    <div class="row gx-0">
                        <div class="col-10">
                        </div>
                        <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="h1 text-white">  Робітник  </th>
                                        <th class="h1 text-white"> День відпустки  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($masterSchedules as $masterSchedule)
                                        <tr>
                                            <td class="h1 text-primary mb-4" >{{ $masterSchedule->master->name }}</td>
                                            <td class="h1 text-primary mb-4">{{ $masterSchedule['work_day'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

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

