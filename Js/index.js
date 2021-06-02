
$(document).ready(function () {
    $(".pagina").removeClass('d-none');
    // $.ajax({
    //     type: "POST",
    //     url: "Api.php",
    //     headers: {
    //         Time: 1622663677,
    //         Hash: 'GekaO.mt.QWvM',
    //         'Content-Type': 'application/json'
    //     },
    //     data:'{"Nombre": "MIGUEL", "Apellidos": "CASTRO"}',
    //     dataType: "json",
    //     success: function (response) {
    //         console.log(response);
    //         $(".navbar-brand").append(response.PLANTILLA);
    //     }
    // });
    $.ajax({
        type: "GET",
        url: "Api.php",
        headers: {
            Time: 1622663677,
            Hash: 'GekaO.mt.QWvM',
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $(".navbar-brand").append(response.PLANTILLA);
        }
    });
    $.ajax({
        type: "GET",
        url: "Api.php",
        headers: {
            Time: 1622666858,
            Hash: 'Ge5FxMWm\/F6\/w',
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function (response) {
            let PLANTILLA = JSON.parse(response.PLANTILLA);
            console.log(PLANTILLA);
            $(".navbar-nav").append(PLANTILLA.PC);
            $(".list-unstyled").append(PLANTILLA.MOVIL);
        }
    });
    // $('#Carga').modal('show');
    // setTimeout(() => {
    //     $(".pagina").removeClass('d-none');
    //     $('#Carga').modal('hide');
    // }, 5000);
    
});