document.addEventListener('DOMContentLoaded', function () {
    darkMode();
    eventListeners();


});

function mostrarPassword() {
    try {
        const passwordInput = document.getElementById('password');
        const icono = document.getElementById('icono-mostrar')

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icono.src = "/build/img/visible.svg"
        } else {
            passwordInput.type = "password";
            icono.src = "/build/img/no-visible.svg"
        }


    } catch (error) {
        console.log(error);
    }

}

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    const btnMostrarPass = document.getElementById('boton-mostrar');
    
    if (btnMostrarPass){
        btnMostrarPass.addEventListener('click', mostrarPassword);
    }
    
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}