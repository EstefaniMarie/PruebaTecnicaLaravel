<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"
            type="text/javascript"></script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js" type="text/javascript">
        </script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Perfil de cuenta</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Perfil de cuenta
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-4 col-12 d-none d-md-inline-block">
            <div class="btn-group float-md-right"><a class="btn-gradient-secondary btn-sm white"
                    href="{{ route('dashboard') }}">Regresar</a>
            </div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12 col-md-8">
            <!-- User Profile -->
            <section class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <img src="{{ asset('theme/CryptoDash') }}/app-assets/images/portrait/medium/avatar-m-1.png"
                                        class="rounded-circle height-100" alt="Card image" />
                                </div>
                                <div class="col-md-10 col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <p class="text-bold-700 text-uppercase mb-0">Cédula</p>
                                            <p class="mb-0">25963415</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <p class="text-bold-700 text-uppercase mb-0">Ultimo ingreso</p>
                                            <p class="mb-0">2024-02-29 16:44:04</p>
                                        </div>
                                        {{-- <div class="col-12 col-md-4">
                                            <p class="text-bold-700 text-uppercase mb-0">IP</p>
                                            <p class="mb-0">127.0.0.1</p>
                                        </div> --}}
                                    </div>
                                    <hr />
                                    @include('profile.partials.update-profile-information-form')
                                    <form class="form-horizontal form-user-profile row mt-2" method="post"
                                        action="{{ route('profile.update') }}">

                                        {{-- <div class="col-4">
                                            <fieldset class="form-label-group">
                                                <input type="password" class="form-control" id="old-password"
                                                    placeholder="Enter Password" required="" autofocus="">
                                                <label for="old-password">Contraseña actual</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="form-label-group">
                                                <input type="password" class="form-control" id="new-password"
                                                    placeholder="Enter Password" required="" autofocus="">
                                                <label for="new-password">Nueva contraseña</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="form-label-group">
                                                <input type="password" class="form-control" id="conf-password"
                                                    placeholder="Enter Password" required="" autofocus="">
                                                <label for="conf-password">Confirmar contraseña</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-12 text-right">
                                            <button type="submit" class="btn-gradient-primary my-1">Save</button>
                                        </div> --}}
                                    </form>
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title text-center">Información del trabajador</h6>
                </div>
                <div class="card-content collapse show">
                    {{-- <div class="card-body">
                        <div class="text-center row clearfix mb-2">
                            <div class="col-12">
                                <i
                                    class="icon-layers font-large-3 bg-warning bg-glow white rounded-circle p-3 d-inline-block"></i>
                            </div>
                        </div>
                        <h3 class="text-center">3,458.88 CIC</h3>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table table-de mb-0">
                            <tbody>
                                <tr>
                                    <td>ID de trabajador</td>
                                    <td>4545</td>
                                    {{-- 
                                        <td>
                                            <i class="icon-layers"></i> 
                                            <i class="cc BTC-alt"></i>
                                            <i class="la la-dollar"></i>
                                            3,258 CIC
                                        </td> 
                                    --}}
                                </tr>
                                <tr>
                                    <td>Estatus</td>
                                    <td>Activo</td>
                                </tr>
                                <tr>
                                    <td>Fecha de ingreso</td>
                                    <td>01/01/2023</td>
                                </tr>
                                <tr>
                                    <td>Fecha de egreso</td>
                                    <td>01/01/2024</td>
                                </tr>
                                <tr>
                                    <td>Unidad</td>
                                    <td>Tecnologia</td>
                                </tr>
                                <tr>
                                    <td>Cargo</td>
                                    <td>Apoyo Administrativo I</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="card">
                <div class="card-header">
                    <h6 class="card-title text-center">Token sale progress</h6>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="font-small-3 clearfix">
                            <span class="float-left">$0</span>
                            <span class="float-right">$5M</span>
                        </div>
                        <div class="progress progress-sm my-1 box-shadow-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"
                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="font-small-3 clearfix">
                            <span class="float-left">Distributed <br> <strong>6,235,125 CIC</strong></span>
                            <span class="float-right text-right">Contributed <br> <strong>5478 ETH | 80
                                    BTC</strong></span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    {{-- <div class="py-12">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div> --}}
</x-app-layout>
