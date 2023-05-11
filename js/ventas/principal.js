
const tablaVentas = '#tablaVentas';
const rutaVentas = 'api/ventas';
const modalRegistro = "#modalRegistro"
const rutaListadoDescuentos = "api/descuentos";
const selectConsola = "#selectConsola";
const formRegistroVenta = "#formRegistroVenta";
const valorJuego = "#valorJuego";

$(_ => {
    listadoVentas();
})

$(document).on("click", `#btnRegistrar`, function () {
    if ($(selectConsola).val() == 'false') {
        Swal.fire(
            'Error',
            'Verifique que todos los campos sean correctos',
            'error'
        )
    } else {
        let formData = {
            funcion: 'descuento',
            consola: $(selectConsola).val(),
            valor: $(valorJuego).val()
        }
        $.ajax({
            "url": rutaVentas,
            type: "post",
            dataType: "json",
            data: formData,
            success: function (data) {
                console.log(data);
                Swal.fire({
                    title: '¿Desea confirmar la compra?',
                    text: "Cobrar al cliente: "+data.valor_descuento,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        registrarVenta(data.valor_a_descontar);
                    } else if (result.isDenied) {
                        Swal.fire('Se declino la compra', '', 'info')
                    }
                })
            },
        });
    }
});

const registrarVenta = (valor_a_descontar) => {
    let formData = {
        funcion: 'guardar',
        consola: $(selectConsola).val(),
        valor_sin_descuento: $(valorJuego).val(),
        valor_a_descontar: valor_a_descontar
    }
    $.ajax({
        "url": rutaVentas,
        type: "post",
        dataType: "json",
        data: formData,
        success: function (data) {
            if (data.status == "success") {
                Swal.fire(data.msg, '', data.status);
                $(tablaVentas).DataTable().ajax.reload(null, false);
                $(modalRegistro).modal("hide");
            }else{
                Swal.fire(data.msg, '', data.status);
            }
        },
    });
};

const listadoVentas = () => {
    $(tablaVentas).DataTable({
        "ajax": {
            "url": rutaVentas,
            "dataSrc": function (json) {
                return json.ventas;
            }
        },
        "paging": false,
        "searching": false,
        "columns": [
            {
                "data": "id",
                "name": "id"
            },
            {
                "data": "descuento",
                "name": "descuento",
                "render": function ( data, type, row, meta ) {
                    console.log(data);
                    if (data == null) {
                        return null;
                    }else{
                        return data.consola
                    }
                  }
            },
            {
                "data": "valor_sin_descuento",
                "name": "valor_sin_descuento"
            },
            {
                "data": "valor_a_descontar",
                "name": "valor_a_descontar"
            },
            {
                "data": "total_venta",
                "name": "total_venta"
            },
        ],
        "responsive": true,
        "language": {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "info": false
    });
};
