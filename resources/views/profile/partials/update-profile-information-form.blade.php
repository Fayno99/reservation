@php use Illuminate\Contracts\Auth\MustVerifyEmail; @endphp
<section>
    <header>
        <div class="container-fluid py-5 wow fadeInUp">
            <div class="container py-5">
                <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                    <h5 class="fw-bold text-primary text-uppercase"> {{ __('Profile Information') }}</h5>
                    <h1 class="mb-0"> {{ __("Update your account's profile information and email address.") }}</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')


            <form>
                <div class="row g-3">
                    <div class="col-md-12">
                        <div>
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" name="name" type="text" class="form-control border-0 bg-light px-4"
                                          style="height: 55px;" :value="old('name', $user->name)" required autofocus
                                          autocomplete="name"/>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-text-input id="email" name="email" type="email" class="form-control border-0 bg-light px-4"
                                      style="height: 55px;" :value="old('email', $user->email)" required
                                      autocomplete="username"/>
                        <x-input-error class="mt-2" :messages="$errors->get('email')"/>

                        @if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification"
                                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">{{ __('Save') }}</button>
                        @if (session('status') === 'profile-updated')
                            <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}
                        @endif
                    </div>
                </div>
            </form>

        </form>
    </div>
</section>
