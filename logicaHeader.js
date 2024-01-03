 // datos para el bar
 let imagenBar = document.getElementById('imagenBar')
 let imagenBarClose = document.getElementById('imagenBarClose')
 let nav = document.getElementById('nav')
 let barActive = true

 // BAR MENU
 function barFuncion() {

    // añadimos la clase "navActive", esto hara que aparesca el nav
    nav.classList.toggle('navActive')

    if (barActive) {

        // se colta el logo del bar
        imagenBar.style.display = 'none'

        // aparece el logo de close
        imagenBarClose.style.display = 'block'

        // ponemos el barActive en false para que cuando se aprete de nuevo valla al else
        barActive = false

    } else {

        // aparecemos el logo de bar
        imagenBar.style.display = 'block'

        // desaparecemos el logo de close
        imagenBarClose.style.display = 'none'

        // ponemos el barActive en true para que cuando se aprete de nuevo valla al if
        barActive = true
    }


    // OCULTAR EL NAV CUANDO SE DE CLICK EN EL <li>
    let liNav = document.getElementsByTagName('li')

    // recorrer los elementos 
    for (let i = 0; i < liNav.length; i++) {

        // por cada li añadimos un evento
        liNav[i].addEventListener('click', () => {

            // removemos la clase navActive para que se valla
            nav.classList.remove('navActive')

            // mostramos la imagen del bar
            imagenBar.style.display = 'block'

            // ocultamos la imagen del close
            imagenBarClose.style.display = 'none'

            // ponemos el barActive en true para que cunado se aprete valla al if
            barActive = true

        })

    }

}



// DETECTAR SCROLL
window.onscroll = function() {

    // obtner valor de scroll
    var y = window.scrollY

    // stilizar el header dependiendo de scroll
    if (y >= 100) {
        document.getElementById('header').classList.add('headerScroll')
        document.getElementById('contenedorLogo').style.display = 'none'
    } else if (y < 100) {
        document.getElementById('header').classList.remove('headerScroll')
        document.getElementById('contenedorLogo').style.display = 'flex'

    }


    // mostrar el boton de ir arriba

    let flechaIrArriba = document.getElementById('flechaIrArriba')

    if (y >= 500) {


        flechaIrArriba.classList.add('contenedorIrArribaActive')
        flechaIrArriba.addEventListener('click', () => {
            irAbajo('')
        })

    } else if (y < 500) {

        flechaIrArriba.classList.remove('contenedorIrArribaActive')
    }
}