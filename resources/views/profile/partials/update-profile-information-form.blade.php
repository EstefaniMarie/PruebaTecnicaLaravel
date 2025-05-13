<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Para actualizar la información de su cuenta debe dirigirse a la Oficina de Tecnología, previamente autorizado por la Oficina de Gestión Humana.') }}
            {{-- {{ __("Actualice la información del perfil y la dirección de correo electrónico de su cuenta.") }} --}}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
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

    <form method="post" action="{{ route('profile.update') }}" class="form-horizontal form-user-profile row mt-2">
        @csrf
        @method('patch')
        <div class="col-6">
            <fieldset class="form-label-group">
                <input type="text" class="form-control" id="name" autocomplete="name"
                    value="{{ old('name', $user->name) }}" required autofocus disabled>
                <label for="name">Nombres</label>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </fieldset>
        </div>
        <div class="col-6">
            <fieldset class="form-label-group">
                <input type="text" class="form-control" id="last-name" value="Doe" required disabled>
                <label for="last-name">Apellidos</label>
            </fieldset>
        </div>
        <div class="col-6">
            <fieldset class="form-label-group">
                <input type="text" class="form-control" id="user-name" value="johndoe9016" disabled>
                <label for="user-name">Usuario</label>
            </fieldset>
        </div>
        <div class="col-6">
            <fieldset class="form-label-group">
                <input type="text" class="form-control" id="email-address" name="email" type="email"
                    value="{{ old('email', $user->email) }}" required disabled autocomplete="username">
                <label for="email-address">Email</label>
            </fieldset>
        </div>


        {{-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
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

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div> --}}
    </form>
</section>
