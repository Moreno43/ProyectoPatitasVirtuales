<section class="latest-podcast-section section-padding pb-10" id="section_2">
    <div class="container">
        <div class="col-lg-12 col-12">
            <div class="section-title-wrap mb-5">
                <h4 class="section-title">Nuestros Productos</h4>
            </div>
        </div>
        <div class="row justify-content-center" id="silder-productos">

            <?php foreach ($datos as $producto) { ?>

                <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                    <div class="custom-block d-flex">
                        <div class="">
                            <div class="custom-block-icon-wrap">
                                <div class="section-overlay"></div>
                                <a href="detail-page.html" class="custom-block-image-wrap">
                                    <img src="<?php echo RUTA . 'assets/'; ?>images/productos/<?php echo $producto['foto_destacada']; ?>" class="custom-block-image img-fluid" alt="">

                                    <a href="#" class="custom-block-icon">
                                        <i class="bi-play-fill"></i>
                                    </a>
                                </a>
                            </div>

                            <?php if ($producto['stock'] > 0) { ?>
                                <div class="mt-2">
                                    <a href="#" class="btn custom-btn" id="carrito_<?php echo $producto['id_producto']; ?>" onclick="agregarCarrito(<?php echo $producto['id_producto']; ?>, event)">
                                        Anadir
                                    </a>
                                </div>
                            <?php }else{
                                echo '<div class="mt-2">
                                <a href="#" class="btn custom-btn bg-warning">
                                    agotado
                                </a>
                            </div>';
                            } ?>

                        </div>

                        <div class="custom-block-info">
                            <div class="custom-block-top d-flex mb-1">
                                <small class="me-4">
                                    <i class="bi-clock-fill custom-icon"></i>
                                    Stock <?php echo $producto['stock']; ?>
                                </small>

                                <small>Precio <span class="badge"><?php echo $producto['precio_normal']; ?></span></small>
                            </div>

                            <h5 class="mb-2">
                                <a href="detail-page.html">
                                    <?php echo $producto['titulo']; ?>
                                </a>
                            </h5>

                        </div>

                        <div class="d-flex flex-column ms-auto">
                            <a href="#" class="badge ms-auto">
                                <i class="bi-heart"></i>
                            </a>

                            <a href="#" class="badge ms-auto">
                                <i class="bi-bookmark"></i>
                            </a>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</section>