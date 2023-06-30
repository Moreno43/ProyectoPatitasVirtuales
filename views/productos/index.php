<form id="frmProducto" autocomplete="off">
    <div class="card mb-2">
        <div class="card-body">
            <input type="hidden" id="id_producto" name="id_producto">
            <input type="hidden" id="imagen_actual" name="imagen_actual">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="">Descripción <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Precio <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Stock <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="">Imagen <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-camera"></i></span>
                        <input type="file" class="form-control" id="imagen" name="imagen">
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
            <table class="table table-striped table-hover" style="width: 100%;" id="table_productos">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Foto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>