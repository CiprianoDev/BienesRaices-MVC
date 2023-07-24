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

    //mostrar campos en formulario contacto 

    const metodoContacto = document.querySelectorAll('input[name="contacto[forma_contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click',mostrarMetodosContacto));
    
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}

function mostrarMetodosContacto(e){
   const contactoDiv = document.querySelector('#contacto');

   if (e.target.value == 'telefono'){
    contactoDiv.innerHTML = `
    <label for="telefono">Ingrese Su Teléfono</label>
    <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]" required>
    <p>Elija la fecha y la hora para la llamada:</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
    `;
   } else {
        contactoDiv.innerHTML = `
        
        <label for="email">Ingrese su E-mail:</label>
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
   }

}