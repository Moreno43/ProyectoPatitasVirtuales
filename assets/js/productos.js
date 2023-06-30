const frm = document.querySelector('#frmProducto');
const descripcion = document.querySelector('#descripcion');
const precio = document.querySelector('#precio');
const imagen_actual = document.querySelector('#imagen_actual');
const nombre = document.querySelector('#nombre');
const stock = document.querySelector('#stock');
const id_producto = document.querySelector('#id_producto');
const btn_nuevo = document.querySelector('#btn-nuevo');
const btn_save = document.querySelector('#btn-save');
document.addEventListener('DOMContentLoaded', function () {

  $('#table_productos').DataTable({
    ajax: {
      url: ruta + 'controllers/productosController.php?option=listar',
      dataSrc: ''
    },
    columns: [
      { data: 'id_producto' },
      { data: 'titulo' },
      { data: 'descripcion_corta' },
      { data: 'precio_normal' },
      { data: 'stock' },
      {
        data: 'foto_destacada',
        render: function (data, type) {
            if (type === 'display') {
                return `<img src="${ruta + 'assets/images/productos/' + data}">`;
            }

            return data;
        },
    },
      { data: 'accion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    },
    "order": [[0, 'desc']]
  });
  frm.onsubmit = function (e) {
    e.preventDefault();
    if (descripcion.value == '' || precio.value == '' || nombre.value == ''
    || stock.value == '') {
      message('error', 'TODO LOS CAMPOS CON * SON REQUERIDOS')
    } else {
      const frmData = new FormData(frm);
      axios.post(ruta + 'controllers/productosController.php?option=save', frmData)
        .then(function (response) {
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
  }
  btn_nuevo.onclick = function () {
    frm.reset();
    id_producto.value = '';
    btn_save.innerHTML = 'Guardar';
    descripcion.focus();
  }
})

function eliminar(id) {
  Snackbar.show({
    text: 'Esta seguro de eliminar',
    width: '475px',
    actionText: 'Si eliminar',
    backgroundColor: '#FF0303',
    onActionClick: function (element) {
      axios.get(ruta + 'controllers/productosController.php?option=delete&id=' + id)
        .then(function (response) {
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

function edit(id) {
  axios.get(ruta + 'controllers/productosController.php?option=edit&id=' + id)
    .then(function (response) {
      const info = response.data;
      descripcion.value = info.descripcion_corta;
      precio.value = info.precio_normal;
      nombre.value = info.titulo;
      stock.value = info.stock;
      id_producto.value = info.id_producto;
      imagen_actual.value = info.foto_destacada;
      btn_save.innerHTML = 'Actualizar';
      descripcion.focus();
    })
    .catch(function (error) {
      console.log(error);
    });
}