var socket = io("http://localhost:3000");
var latitud_input = document.querySelector('#latitud');
var longitud_input = document.querySelector('#longitud');
var longitud_real = 0;
var latitud_real = 0;
var pat = 0;
var init;

window.onload = function (){
    var patente = document.querySelector('#patente');
    pat = patente.innerHTML;
    init = setInterval(iniciar, 1000);
}

/*socket.on('new message', function(data){
    console.log(data);
});*/

function iniciar(){
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    else{
        clearInterval(init);
    }
}

function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    if (latitude !== latitud_real || longitude !== longitud_real) {
        latitud_input.value = latitude;
        longitud_input.value = longitude;

        latitud_real = latitude;
        longitud_real = longitude;
        socket.emit('send message', {long: longitud_real, lat: latitud_real, pat: pat});
    }
}

