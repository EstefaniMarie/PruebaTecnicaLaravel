@php
    use App\Models\User;
    use App\Models\Task;
    $users = User::get();
    $tareas = Task::get();
@endphp
<x-app-layout>
    <div class="d-flex justify-content-end mr-5">
        <a class="btn btn-gradient-primary btn-sm white" data-toggle="modal" data-target="#addTareaModal">
            Registrar Tarea
        </a>
    </div>
    @include('layouts.mensajes')
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
                var table = $('#prueba').DataTable({
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
                    ],
                    search: {
                        "search": "" 
                    }
                });

                $('#title-filter').on('keyup', function () {
                    table.column(0).search(this.value).draw();
                });

                $('#status-filter').on('change', function () {
                    table.column(3).search(this.value).draw();
                });

                $('#priority-filter').on('change', function () {
                    table.column(4).search(this.value).draw();
                });

            });
        </script>
    </x-slot>
    <x-modal name="addTareaModal" route="{{ route('crearTask') }}" title="Registrar Tarea">
        <div class="row">
            <div class="col-12">
                <fieldset class="name form-group">
                    <label for="name" style="color:black;">Título</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="correo form-group">
                    <label for="correo" style="color:black;">Descripción</label>
                    <input type="text" class="correo form-control" id="description" name="description" required>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="correo form-group">
                    <label for="correo" style="color:black;">Plazo</label>
                    <input type="text" class="correo form-control" id="due_date" name="due_date" required>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label>Estatus</label>
                    <select class="form-control" name="status" required>
                        <option value="" disabled selected>Selecciona un estatus</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="en progreso">En progreso</option>
                        <option value="completada">Completada</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label>Prioridad</label>
                    <select class="form-control" name="priority" required>
                        <option value="" disabled selected>Selecciona una prioridad</option>
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="alta">Alta</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="form-group">
                    <label for="user_id" style="color:black;">Usuario</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">Seleccione un usuario</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->correo }})</option>
                        @endforeach
                    </select>
                </fieldset>
            </div>
        </div>
    </x-modal>
    </div>
    <div class="row mb-3 mt-5">
        <div class="col-md-4">
            <label for="title-filter">Filtrar por Título:</label>
            <div class="input-group">
                <input type="text" id="title-filter" class="form-control">
                <div class="input-group-append">
                    <button id="title-btn" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="status-filter">Filtrar por Estatus:</label>
            <div class="input-group">
                <select id="status-filter" class="form-control">
                    <option value="">Todos</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="en progreso">En progreso</option>
                    <option value="completada">Completada</option>
                </select>
                <div class="input-group-append">
                    <button id="status-btn" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="priority-filter">Filtrar por Prioridad:</label>
            <div class="input-group mr-2">
                <select id="priority-filter" class="form-control">
                    <option value="">Todas</option>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                </select>
                <div class="input-group-append">
                    <button id="priority-btn" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row" style="display: flex; justify-content: center;">
        <div id="recent-transactions" class="col-10">
            <h6 class="my-2"></h6>
            <div class="card">
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="prueba" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Título</th>
                                    <th class="border-top-0">Descripción</th>
                                    <th class="border-top-0">Plazo</th>
                                    <th class="border-top-0">Estatus</th>
                                    <th class="border-top-0">Prioridad</th>
                                    <th class="border-top-0">Usuario</th>
                                    <th class="border-top-0 no-export"></th>
                                    <th class="border-top-0 no-export"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyResultados">
                                @foreach ($tareas as $tarea)
                                    <tr>
                                        <td class="text-truncate">{{ $tarea->title }}</td>
                                        <td class="text-truncate">{{ $tarea->description }}</td>
                                        <td class="text-truncate">{{ $tarea->due_date }}</td>
                                        <td class="text-truncate">{{ $tarea->status }}</td>
                                        <td class="text-truncate">{{ $tarea->priority }}</td>
                                        <td class="text-truncate">{{ $tarea->user->name }}</td>
                                        <td class="text-truncate">
                                            <button type="button" data-toggle="modal"
                                                data-target="#editarTareaModal{{ $tarea->id }}" class="editar-tarea-btn">
                                                <img src="images/editar.ico" width="24px" height="24px" alt="Editar">
                                            </button>
                                            @include('modalEditarTask')
                                        </td>
                                        <td class="text-truncate">
                                            <form action="{{ route('tareas.eliminar', $tarea->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background: none;">
                                                    <img src="images/eliminar.ico" width="24px" height="24px"
                                                        alt="Eliminar">
                                                </button>
                                                </>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    div.dataTables_filter {
        display: none;
    }
</style>