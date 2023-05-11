const tablaDescuentos = '#tablaDescuento';
const rutaDescuentos = 'api/descuentos';

$(_ => {
    listadoDescuentos();
    optionsConsolas();
})

const optionsConsolas = () => {
    $.ajax({
        "url": rutaListadoDescuentos,
        "type": "GET",
        dataType: 'json',
        success: function (data) {
            $(selectConsola).append($("<option>", {
                value: false,
                text: "Seleccione una consola"
            }));
            for (var i = 0; i < data.descuentos.length; i++) {
                $(selectConsola).append($("<option>", {
                    value: data.descuentos[i]["consola"],
                    text: data.descuentos[i]["consola"]
                }));
            }
        },
    });
};

const listadoDescuentos = () => {
    $(tablaDescuentos).DataTable({
        "ajax": {
            "url": rutaDescuentos,
            "dataSrc": function (json) {
                return json.descuentos;
            }
        },
        "paging": false,
        "searching": false,
        "columns": [
            {
                "data": "consola",
                "name": "consola"
            },
            {
                "data": "precio_minimo",
                "name": "precio_minimo"
            },
            {
                "data": "precio_maximo",
                "name": "precio_maximo"
            },
            {
                "data": "porcentaje",
                "name": "porcentaje"
            },
        ],
        "responsive": true,
        "language": {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "info": false
    });
};
