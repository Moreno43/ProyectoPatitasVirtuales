document.addEventListener('DOMContentLoaded', function () {

    $('#table_pedidos').DataTable({
        ajax: {
            url: ruta + 'controllers/pedidosController.php?option=listar',
            dataSrc: ''
        },
        columns: [
            { data: 'accion' },
            { data: 'id' },
            { data: 'transaccion' },
            { data: 'productos' },
            { data: 'cantidad' },
            { data: 'nombre' },
            { data: 'telefono' },
            { data: 'direccion' },            
            { data: 'total' }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
        },
        "order": [[1, 'desc']]
    });
})

function cambiar(id) {
    Snackbar.show({
        text: 'Cambiar estado del pedido',
        width: '475px',
        actionText: 'Si completar',
        backgroundColor: '#127D02 ',
        onActionClick: function (element) {
            axios.get(ruta + 'controllers/pedidosController.php?option=cambiar&id=' + id)
                .then(function (response) {
                    console.log(response);
                    const info = response.data;
                    message(info.tipo, info.mensaje);
                    if (info.tipo == 'success') {
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    });

}