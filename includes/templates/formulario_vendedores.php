<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedores[nombre]" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedores->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedores[apellido]" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedores->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="vendedores[telefono]" placeholder="Telefono Vendedor(a)" value="<?php echo s($vendedores->telefono); ?>">

</fieldset>