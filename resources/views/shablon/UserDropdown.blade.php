
    @if(Auth::user())
        <div class="nav-item dropdown">
    <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
    <div class="dropdown-menu m-0">

        <x-dropdown-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-dropdown-link>


        @if(Auth::user()->isUser())
            <x-dropdown-link href="{{ asset('schedules/'.Auth::user()->id) }}">
                {{ __('history') }}
            </x-dropdown-link>
        @endif

        @if(Auth::user()->isAdmin()||Auth::user()->isManager())
            <x-dropdown-link href="{{ asset('dayOff')}}" >
                {{ __('Вихідний Майстра') }}
            </x-dropdown-link>
        @endif

        @if(Auth::user()->isAssistant()||Auth::user()->isAdmin())
            <x-dropdown-link  href="{{ asset('schedules')}}"  >
                {{ __('Графік робіт') }}
            </x-dropdown-link>
        @endif

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                             onclick="event.preventDefault();
                        this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>

        </form>
    </div>
    </div>
@endif
</div>




<button type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
@if (Route::has('login'))
    @auth
        <a
            href="{{ url('/profile') }}"
            class="btn btn-primary py-2 px-4 ms-3"                        >
            Панель керування
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="btn btn-primary py-2 px-4 ms-3"                        >
            Увійти
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="btn btn-primary py-2 px-4 ms-3"                            >
                Реєстрація
            </a>
            @endif
            @endauth
            @endif
