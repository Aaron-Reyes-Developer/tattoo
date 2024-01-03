function alertaPersonalizada(titulo, texto, icono, textoBoton, regresar){
    Swal.fire({
        title: titulo,
        text: texto,
        icon: icono,
        confirmButtonText: textoBoton,
        allowEscapeKey:false,
        allowEnterKey:true,
        allowOutsideClick:false,
        color: '#424242'
    }).then( e =>{
        if(e.isConfirmed && regresar == 'si'){
            window.history.back()
        }
    })
};

