<form id="frmUser" autocomplete="off">
    <div class="card mb-2">
        <div class="card-body">
            <input type="hidden" id="id_user" name="id_user">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Correo <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Telefono <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Contrasena <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="button" class="btn btn-danger" id="btn-nuevo">Nuevo</button>
            <button type="submit" class="btn btn-primary" id="btn-save">Guardar</button>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 100%;" id="table_users">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Teléfono</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>