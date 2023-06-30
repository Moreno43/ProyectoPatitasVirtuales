<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>index/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>index/css/bootstrap-icons.css">

    <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>index/css/owl.carousel.min.css">

    <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>index/css/owl.theme.default.min.css">

    <link href="<?php echo RUTA . 'assets/'; ?>index/css/templatemo-pod-talkin.css" rel="stylesheet">
    <link href="<?php echo RUTA . 'assets/'; ?>index/slick/slick/slick.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA . 'assets/'; ?>index/slick/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA . 'assets/'; ?>index/css/modal.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA . 'assets/'; ?>css/snackbar.min.css" />

    <!--

TemplateMo 584 Pod Talk

https://templatemo.com/tm-584-pod-talk

-->
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID_PAYPAL; ?>&currency=USD"></script>
</head>

<body>

    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand me-lg-5 me-0" href="<?php echo RUTA; ?>">
                    <img src="<?php echo RUTA . 'assets/'; ?>images/logo.png" class="logo-image img-fluid" alt="templatemo pod talk">
                </a>

                <form action="#" method="get" class="custom-form search-form flex-fill me-3" role="search">
                    <div class="input-group input-group-lg">
                        <input name="search" type="search" class="form-control" id="search" placeholder="Buscar productos" aria-label="Search" autocomplete="off">

                        <button type="submit" class="form-control" id="submit">
                            <i class="bi-search"></i>
                        </button>
                    </div>
                </form>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="plantilla.php?pagina=login">Admin</a>
                        </li>
                    </ul>

                    <div class="ms-4">
                        <a href="plantilla.php?pagina=carrito" class="btn custom-btn custom-border-btn position-fixed <?php echo ($carrito) ? '' : 'd-none'; ?>">Carrito <span class="text-warning" id="carrito"><?php echo !empty($_SESSION['carrito']['productos']) ? count($_SESSION['carrito']['productos']) : 0; ?></span></a>
                    </div>
                </div>
            </div>
        </nav>