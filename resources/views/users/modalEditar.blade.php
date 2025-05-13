<div class="modal fade" id="editarUsuarioModal{{ $user->id }}" tabindex="-1"
    aria-labelledby="editarUsuarioModal{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModal{{ $user->id }}">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="{{ route('usuario.actualizar', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="name form-group">
                                <label for="name" style="color:black;">Nombre y Apellido</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="correo form-group">
                                <label for="correo" style="color:black;">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="password" style="color:black;">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </fieldset>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 text-center">
                                <button type="reset" class="btn-gradient-secondary btn-sm white"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                            <div class="col-6 text-center">
                                <button type="submit" class="btn-gradient-primary btn-sm white">Editar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
