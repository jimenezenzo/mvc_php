var mapa = L.map('map');
var socket = io("http://localhost:3000");
var pathname = location.pathname;
var patente = pathname.substring(17);
var mark;
initMap(-34.6699, -58.5622);

socket.on('tiempo real', function(data){
    if (data.pat === patente){
        setView(data.lat, data.long, data.pat)
    }
});

function initMap(lat, lng) {
    mapa.setView([lat, lng], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapa);

    mark = L.marker([lat, lng]).addTo(mapa)
        .bindPopup('unlam')
        .openPopup();
}

function setView(lat, lng, pat){
    mapa.removeLayer(mark);

    mapa.panTo(new L.LatLng(lat, lng));

    mark = L.marker([lat, lng]).addTo(mapa)
        .bindPopup('Patente: '+pat)
        .openPopup();
}
