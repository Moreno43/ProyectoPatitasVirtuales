<?php
//Este controlador representa la clase Home con un método index() que se encarga de cargar los datos necesarios y las vistas correspondientes 
//para mostrar la página de inicio de la tienda virtual. 

class Home{
    
    public function index()
    {
        require_once 'models/home.php'; // Se incluye el archivo del modelo HomeModel
        $products = new HomeModel(); // Se crea una instancia del modelo HomeModel
        $datos = $products->getproducts(); // Se obtienen los productos mediante el método getproducts() del modelo
        $nuevos = $products->getproductsNuevos(); // Se obtienen los productos nuevos mediante el método getproductsNuevos() del modelo
        $carrito = true; // Variable que indica si se debe mostrar el carrito (en este caso, siempre es true)
        include 'views/includes/menu-carrito.php'; // Se incluye el archivo del menú del carrito
        include 'views/includes/slider.php'; // Se incluye el archivo del slider
        include 'views/index.php'; // Se incluye el archivo de la vista principal (página de inicio)
        include 'views/includes/footer-carrito.php'; // Se incluye el archivo del footer del carrito
    }
}

