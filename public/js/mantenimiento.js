var opciones;
var boton;
function mostrarOpciones(id){
    boton = document.querySelector('#boton'+id);
    opciones = document.querySelector('#opciones'+id);
    console.log(boton.value);
    if (boton.value === 'ocultar'){
        opciones.style.display = 'block';
        boton.value = 'mostrar';
    }
    else {
        opciones.style.display = 'none';
        boton.value = 'ocultar';
    }
}