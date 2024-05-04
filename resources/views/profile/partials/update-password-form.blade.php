<section>
    <header>
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                    <h5 class="fw-bold text-primary text-uppercase"> {{ __('Update Password') }} </h5>
                    <h1 class="mb-0"> {{ __('Ensure your account is using a long, random password to stay secure.') }}</h1>
                </div>
            </div>
        </div>
    </header>



            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')


                <form>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div>
                                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                                <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control border-0 bg-light px-4" style="height: 55px;" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <x-input-label for="update_password_password" :value="__('New Password')" />
                            <x-text-input id="update_password_password" name="password" type="password"  class="form-control border-0 bg-light px-4"  style="height: 55px;"   style="height: 55px;" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>
                        <div class="col-md-12">

                            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"  class="form-control border-0 bg-light px-4"  style="height: 55px;" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />

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

    </div>
</section>
