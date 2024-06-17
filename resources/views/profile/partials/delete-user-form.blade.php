<section class="space-y-6">
    <header>
        <div class="container-fluid py-5 wow fadeInUp" >
            <div class="container py-5">
                <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                    <h5 class="fw-bold text-primary text-uppercase"> {{ __('Delete Account') }}</h5>
                    <h1 class="mb-0">             {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </h1>
                </div>
            </div>
        </div>
       </header>

            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn btn-primary w-100 py-3"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mb-3 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>
            <div class="container-fluid py-5 wow fadeInUp   " >
                <div class="container row g-5">
            <div class="col-md-12">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control border-0 bg-light px-4"  style="height: 55px;"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
                </div>
            </div>
        </form>
    </x-modal>

    </div>
</section>
