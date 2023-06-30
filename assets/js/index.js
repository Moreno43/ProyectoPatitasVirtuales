document.addEventListener('DOMContentLoaded', function () {
    totales()
})
function totales() {
    axios.get(ruta + 'controllers/adminController.php?option=totales')
        .then(function (response) {
            const info = response.data;
            console.log(info);
            document.querySelector('#totalUsuarios').textContent = info.usuario.total;
            document.querySelector('#totalProductos').textContent = info.productos.total;
            document.querySelector('#totalPedidos').textContent = info.pedidos.total;
            document.querySelector('#totalIngresos').textContent = info.ingresos.total;
        })
        .catch(function (error) {
            console.log(error);
        });
}