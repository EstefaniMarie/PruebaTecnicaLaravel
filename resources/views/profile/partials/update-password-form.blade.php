<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Actualizar contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="row mt-2">
            <div class="col-4">
                <fieldset class="form-label-group">
                    <input type="password" class="form-control" id="old-password" placeholder="Enter Password" required
                        name="current_password" autocomplete="current-password">
                    <label for="old-password">Contraseña actual</label>
                </fieldset>
            </div>
            <div class="col-4">
                <fieldset class="form-label-group">
                    <input type="password" class="form-control" id="new-password" placeholder="Enter Password" required
                        name="password" autocomplete="new-password">
                    <label for="new-password">Nueva contraseña</label>
                </fieldset>
            </div>
            <div class="col-4">
                <fieldset class="form-label-group">
                    <input type="password" class="form-control" id="conf-password" placeholder="Enter Password" required
                        name="password_confirmation" autocomplete="new-password">
                    <label for="conf-password">Confirmar contraseña</label>
                </fieldset>
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="btn-gradient-primary my-1">Cambiar contraseña</button>
            </div>
        </div>


        <div class="flex items-center gap-4">
            {{-- <x-primary-button>{{ __('Save') }}</x-primary-button> --}}

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
