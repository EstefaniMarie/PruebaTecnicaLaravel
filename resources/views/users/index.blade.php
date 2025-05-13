@php
    use App\Models\User;
    $users = User::get();
@endphp

<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
        <style>
            button.dt-button,
            div.dt-button,
            a.dt-button,
            input.dt-button {
                color: #fff !important;
                background-color: #007bff !important;
                border-color: #007bff !important;
                margin: 1rem !important;
                padding: .375rem .75rem !important;
                font-size: 1rem !important;
                line-height: 1.5 !important;
                border-radius: .25rem !important;
                cursor: pointer !important;
            }

            #prueba_filter.dataTables_filter {
                margin: 1rem !important;
            }
        </style>
    </x-slot>
    <x-slot name="js">
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#prueba').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: ':visible:not(.no-export)',
                                header: false
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible:not(.no-export)',
                                header: false
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible:not(.no-export)',
                                header: false
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible:not(.no-export)',
                                header: false
                            }
                        },
                        'colvis'
                    ]
                });
            });
        </script>
    </x-slot>
    <x-modal name="addUserModal" route="{{ route('crearUser') }}" title="Registrar Usuario">
        <div class="row">
            <div class="col-12">
                <fieldset class="name form-group">
                    <label for="name" style="color:black;">Nombre y Apellido</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="form-group">
                    <label for="role" style="color:black;">Rol de Usuario</label>
                    <select class="form-control" id="roles_id" name="roles_id" onchange="validateRole()">
                        <option value="" disabled selected>Selecciona un Rol</option>
                        <option value="1" class="role-option">Administrador</option>
                        <option value="2" class="role-option">Usuario</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="correo form-group">
                    <label for="correo" style="color:black;">Correo electrónico</label>
                    <input type="email" class="correo form-control" id="correo" name="correo" required>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="form-group">
                    <label for="password" style="color:black;">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </fieldset>
            </div>
        </div>
    </x-modal>
    <x-slot name="header">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Usuarios</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-4 col-12 d-none d-md-inline-block">
            <div class="btn-group float-md-right">
                <a class="btn-gradient-primary btn-sm white mr-2" data-toggle="modal"
                    data-target="#addUserModal">Registrar Usuario</a>
            </div>
        </div>
        @include('layouts.mensajes')
    </x-slot>
    <div class="row" style="display: flex; justify-content: center;">
        <div id="recent-transactions" class="col-10">
            <h6 class="my-2"></h6>
            <div class="card">
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="prueba" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Nombre y Apellido</th>
                                    <th class="border-top-0">Correo Electronico</th>
                                    <th class="border-top-0 no-export"></th>
                                    <th class="border-top-0 no-export"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyResultados">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-truncate">{{ $user->name }}</td>
                                        <td class="text-truncate">{{ $user->correo }}</td>
                                        <td class="text-truncate">
                                            <button type="button" data-toggle="modal"
                                                data-target="#editarUsuarioModal{{ $user->id }}" class="editar-usuario-btn"
                                                style="border: none; background: none;">
                                                <img src="images/editar.ico" width="24px" height="24px" alt="Editar">
                                            </button>
                                        </td>
                                        @include('users.modalEditar')
                                        <td class="text-truncate">
                                            <form action="{{ route('usuario.eliminar', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background: none;">
                                                    <img src="images/eliminar.ico" width="24px" height="24px"
                                                        alt="Eliminar">
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</x-app-layout>