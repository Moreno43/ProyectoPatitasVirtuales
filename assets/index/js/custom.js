
(function ($) {

  "use strict";

  // MENU
  $('.navbar-collapse a').on('click', function () {
    $(".navbar-collapse").collapse('hide');
  });

  // CUSTOM LINK
  $('.smoothscroll').click(function () {
    var el = $(this).attr('href');
    var elWrapped = $(el);
    var header_height = $('.navbar').height();

    scrollToDiv(elWrapped, header_height);
    return false;

    function scrollToDiv(element, navheight) {
      var offset = element.offset();
      var offsetTop = offset.top;
      var totalScroll = offsetTop - 0;

      $('body,html').animate({
        scrollTop: totalScroll
      }, 300);
    }
  });

  $('.owl-carousel').owlCarousel({
    center: true,
    loop: true,
    margin: 30,
    autoplay: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
      },
      767: {
        items: 3,
      },
      1200: {
        items: 4,
      }
    }
  });

  $('#silder-productos').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

})(window.jQuery);

function agregarCarrito(id_producto, e) {
  e.preventDefault();
  const frmData = new FormData();
  frmData.append('id_producto', id_producto);
  axios.post(ruta + 'controllers/carritoController.php?option=agregar', frmData)
    .then(function (response) {
      const res = response.data;
      console.log(res);
      if (res.icono == 'success') {
        document.getElementById('carrito').textContent = res.total;
      }
      message(res.icono, res.msg);
    })
    .catch(function (error) {
      console.log(error);
    });
}

function eliminarProducto(id_producto, e) {
  e.preventDefault();
  axios.get(ruta + 'controllers/carritoController.php?option=eliminar&id=' + id_producto)
    .then(function (response) {
      const res = response.data;
      if (res.icono == 'success') {
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      }
      message(res.icono, res.msg);
    })
    .catch(function (error) {
      console.log(error);
    });
}

function procesarpago() {
  const btnProcesar = document.getElementById('container-envio');
  const nombre = document.getElementById('nombre');
  const direccion = document.getElementById('direccion');
  const telefono = document.getElementById('telefono');
  if (nombre.value == '' || direccion.value == '' || telefono.value == '') {
    message('error', 'Los datos de envio son requeridos');
  } else {
    axios.get(ruta + 'controllers/carritoController.php?option=ver')
      .then(function (response) {
        const res = response.data;
        btnProcesar.classList.add('d-none');
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

          // Set up the transaction
          createOrder: function (data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: `${res}`
                }
              }]
            });
          },

          // Finalize the transaction
          onApprove: function (data, actions) {
            return actions.order.capture().then(function (orderData) {
              savePedido(orderData);
            });
          }


        }).render('#paypal-button-container');
      })
      .catch(function (error) {
        console.log(error);
      });
  }
}

function savePedido(details) {
  const nombre = document.getElementById('nombre');
  const direccion = document.getElementById('direccion');
  const telefono = document.getElementById('telefono');
  axios.post(ruta + 'controllers/pedidosController.php?option=savePedido', {
    nombre : nombre.value,
    direccion : direccion.value,
    telefono : telefono.value,
    detalle : details
  })
    .then(function (response) {
      const res = response.data;
      if (res.tipo == 'success') {
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      }
      message(res.tipo, res.mensaje);
    })
    .catch(function (error) {
      console.log(error);
    });
}