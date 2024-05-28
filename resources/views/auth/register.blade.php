<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <div class="row g-3">
        <!-- Name -->
        <div class="col-md-12" >
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="form-control border-0 bg-light px-4" placeholder="Your Name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  style="height: 55px;"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="col-md-12">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control border-0 bg-light px-4" placeholder="Your Email" type="email" name="email" :value="old('email')" required autocomplete="username" style="height: 55px;"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="col-md-12">
            <x-input-label for="email" :value="__('Telephone')" />
            <x-text-input id="telephone" class="form-control border-0 bg-light px-4" placeholder="Your Telephone" type="telephone" name="telephone" :value="old('telephone')" required autocomplete="telephone" style="height: 55px;"/>
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="col-md-12">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="form-control border-0 bg-light px-4" style="height: 55px;" placeholder="Password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
            <div class="col-md-12">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full form-control border-0 bg-light px-4" style="height: 55px;" placeholder="Confirm Password"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="col-md-6">
            <a class="btn btn-primary w-100 py-3" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
            <div class="col-md-6">
            <x-primary-button  class="btn btn-primary w-100 py-3">
                {{ __('Register') }}
            </x-primary-button>
        </div>
      </div>
     </div>
    </form>




</x-guest-layout>
