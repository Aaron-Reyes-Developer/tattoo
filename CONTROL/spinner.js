// mostrar spiner
function mostrarLoader() {

    document.documentElement.scrollTop = 0


    // mostrar el spiner
    document.getElementById('body').insertAdjacentHTML('afterbegin', `
        <div id="contenedorLoaderMain" class="contenedorLoaderMain">
            <div class="custom-loader"></div>
        </div>
    
    `)

    document.body.style.overflow = 'hidden';
}


// ocultar spiner
function ocultarLoader() {

    document.body.style.overflow = 'auto';

    // obtener datos
    document.getElementById('contenedorLoaderMain').remove()


}