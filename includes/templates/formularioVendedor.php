<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre del vendedor" value="<?php echo s($vendedor->nombre) ?>">

    <label for="apellido">Apellido:</label>
    <input name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido" value="<?php echo s($vendedor->apellido) ?>">

    <label for="telefono">Telefono:</label>
    <input name="vendedor[telefono]" type="tel" id="telefono" placeholder="Telefono del vendedor (10 digitos)" value="<?php echo s($vendedor->telefono) ?>">

    
</fieldset>




