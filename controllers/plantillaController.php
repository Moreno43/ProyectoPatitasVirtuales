<?php
class Plantilla{
    // pagina carrito //
    public function carrito()
    {
        require_once 'models/home.php';
        $products = new HomeModel();
        $results = [];
        if (isset($_SESSION['carrito']['productos'])) {
            if (!empty($_SESSION['carrito']['productos'])) {
                foreach ($_SESSION['carrito']['productos'] as $id => $cantidad) {
                    $datos = $products->getproduct($id); // Se obtienen los datos del producto mediante el método getproduct() del modelo HomeModel
                    $producto['id'] = $id;
                    $producto['imagen'] = $datos['foto_destacada'];
                    $producto['nombre'] = $datos['titulo'];
                    $producto['cantidad'] = $cantidad;
                    $producto['precio'] = $datos['precio_normal'];
                    $results[] = $producto;
                }
            }
        } 
        $carrito = false;      
        include 'views/includes/menu-carrito.php';
        include 'views/carrito.php';
        include 'views/includes/footer-carrito.php';
    }

    // pagina login //
    public function login()
    {
        include_once 'views/login.php';
    }
    
    // pagina principal //
    public function index()
    {
        include_once 'views/principal.php';
    }
    public function productos()
    {
        include_once 'views/productos/index.php';
    }
    public function pedidos()
    {
        include_once 'views/pedidos/index.php';
    }
    // pagina usuarios //
    public function usuarios()
    {
        include_once 'views/usuarios/index.php';
    }
    // pagina configuracion //
    public function configuracion()
    {
        include_once 'views/usuarios/configuracion.php';
    }
    // PAGINA DE ERRROR //
    public function notFound()
    {
        include_once 'views/errors.php';
    }

}
?>
