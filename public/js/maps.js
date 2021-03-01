var mapa = L.map('map');

window.onload = function (){
    var pathname = location.pathname;
    var id = pathname.substring(18);
    maps(id);
}

function maps(id){
    axios('http://localhost/api/consultarUbicacion/'+id)
    .then(data => {
        initMap(parseFloat(data.data[0].latitud) , parseFloat(data.data[0].longitud), data.data)
    })
}

function initMap(lat, lng, data) {
    mapa.setView([lat, lng], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapa);

    data.forEach(data => {
        L.marker([data.latitud, data.longitud]).addTo(mapa)
            .bindPopup(data.fecha)
            .openPopup();
    })
}

function setView(lat, lng){
    mapa.panTo(new L.LatLng(lat, lng));
}
