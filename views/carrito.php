<link rel="icon" href="logo.png" type="image/png">

<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Carrito</h2>
            </div>
        </div>
    </div>
</header>



<section class="latest-podcast-section section-padding pb-10" id="section_2">
    <?php if (isset($_SESSION['carrito']['productos'])) {


        if (!empty($_SESSION['carrito']['productos'])) { ?>
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-7 col-12">
                        <div class="section-title-wrap mb-5">
                            <h4 class="section-title">Productos</h4>
                        </div>

                        <div class="row">
                            <?php $total = 0;
                            foreach ($results as $row) {
                                $total += $row['precio'] * $row['cantidad'];
                            ?>
                                <div class="col-lg-3 col-12">
                                    <div class="custom-block-icon-wrap">
                                        <div class="custom-block-image-wrap custom-block-image-detail-page">
                                            <img src="<?php echo RUTA; ?>assets/images/productos/<?php echo $row['imagen']; ?>" class="" width="150">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-12 mb-2">
                                    <div class="custom-block-info">
                                        <div class="custom-block-top d-flex mb-1">
                                            <button class="btn btn-outline-secondary btn-sm mx-2" onclick="restarCantidad(<?php echo $row['id']; ?>, <?php echo $row['precio']; ?>)"><i class="fas fa-minus"></i></button>
                                            <small>
                                                <i class="bi-clock-fill custom-icon"></i>
                                                cantidad: <span id="cantidad-<?php echo $row['id']; ?>"><?php echo $row['cantidad']; ?></span>
                                            </small>
                                            <button class="btn btn-outline-secondary btn-sm mx-2" onclick="sumarCantidad(<?php echo $row['id']; ?>, <?php echo $row['precio']; ?>)"><i class="fas fa-plus"></i></button>
                                            <a href="#" class="btn btn-outline-danger btn-sm mx-2" onclick="eliminarProducto(<?php echo $row['id']; ?>, event)"><i class="fas fa-times-circle"></i></a>
                                        </div>

                                        <h6 class="mb-2"><?php echo $row['nombre']; ?></h6>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="section-title-wrap mb-5">
                            <h6 class="section-title">Total a pagar <span class="text-info" id="total-pagar"><?php echo number_format($total, 2); ?></span></h6>
                        </div>
                        <hr>
                        <div id="container-envio">
                            <p class="text-center">Detalle del envio</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nombre</span>
                                <input class="form-control" id="nombre" type="text" autocomplete="off" placeholder="Ejemplo: Larry">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Dirección</span>
                                <input class="form-control" id="direccion" type="text" autocomplete="off" placeholder="Pedregal">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Telefono</span>
                                <input class="form-control" id="telefono" type="text" autocomplete="off" placeholder="1234567890">
                            </div>
                            <div class="d-grid mb-3">
                                <button class="btn custom-btn" type="button" onclick="procesarpago()">Procesar</button>
                            </div>
                        </div>

                        <div id="paypal-button-container"></div>
                    </div>

                </div>
            </div>
        <?php }
    } else { ?>
        <div class="section-title-wrap mb-5">
            <h4 class="section-title">carrito vacio</h4>
        </div>
    <?php } ?>
</section>

<script>
    function sumarCantidad(id, precio) {
        var cantidadElement = document.getElementById('cantidad-' + id);
        var cantidad = parseInt(cantidadElement.innerText);
        cantidad++;
        cantidadElement.innerText = cantidad;

        var totalElement = document.getElementById('total-pagar');
        var total = parseFloat(totalElement.innerText.replace(',', ''));
        total += precio;
        totalElement.innerText = total.toFixed(2);
    }

    function restarCantidad(id, precio) {
        var cantidadElement = document.getElementById('cantidad-' + id);
        var cantidad = parseInt(cantidadElement.innerText);
        if (cantidad > 1) {
            cantidad--;
            cantidadElement.innerText = cantidad;

            var totalElement = document.getElementById('total-pagar');
            var total = parseFloat(totalElement.innerText.replace(',', ''));
            total -= precio;
            totalElement.innerText = total.toFixed(2);
        }
    }
</script>