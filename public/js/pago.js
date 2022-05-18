$(document).ready(function(){
    let radioTarjeta = $("#tarjeta").click(() => {
        let seccionPago = $("#seccion-pago");
        seccionPago.removeClass("hidden-input");
        seccionPago.find("label").html("Numero de tarjeta");
        let input = seccionPago.find("input");
        input.removeAttr("readonly");
        input.val("");
    });

    let radioTransferencia = $("#tranferencia").click(() => {
        let seccionPago = $("#seccion-pago");
        seccionPago.removeClass("hidden-input");
        seccionPago.find("label").html("Codigo de transferencia");
        let input = seccionPago.find("input");
        input.attr("readonly",true);
        input.val(getRandomNum(18));
    });

    function getRandomNum(length) {
        let randomNum = 
            (Math.pow(10,length).toString().slice(length-1) + 
            Math.floor((Math.random()*Math.pow(10,length))+1).toString()).slice(-length);
        return randomNum;
    }
});