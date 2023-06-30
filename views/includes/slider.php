<section class="hero-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <div class="text-center mb-5 pb-2">
                    <h1 class="text-white">Patitas Virtuales</h1>

                    <p class="text-white">Envios Gratis para esos chandosos :P</p>

                    <a href="#section_2" class="btn custom-btn smoothscroll mt-3">Ver productos!</a>
                </div>

                <div class="owl-carousel owl-theme">
                    <?php foreach ($nuevos as $producto) { ?>
                        <div class="owl-carousel-info-wrap item">
                            <img src="<?php echo RUTA . 'assets/'; ?>images/productos/<?php echo $producto['foto_destacada']; ?>" class="owl-carousel-image" alt="">

                            <div class="owl-carousel-info">
                                <h6 class="mb-2">
                                    <?php echo $producto['titulo']; ?>
                                </h6>

                                Stock: <span class="badge bg-info"><?php echo $producto['stock']; ?></span>
                                Precio: <span class="badge">$<?php echo $producto['precio_normal']; ?></span>

                            </div>

                            <div class="social-share">
                                <ul class="social-icon">
                                    <?php if ($producto['stock'] > 0) { ?>
                                        <li class="social-icon-item">
                                            <a href="" class="social-icon-link bi-cart-dash-fill" id="carrito_<?php echo $producto['id_producto']; ?>" onclick="agregarCarrito(<?php echo $producto['id_producto']; ?>, event)"></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</section>