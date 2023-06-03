<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Propiedad" value="<?php echo s($propiedad->titulo); ?>"> <!--El value es para que se guarde el valor una vez se ingrese aunque hayan fallos o no se ingresen los demas inputs-->

    <label for="precio">Precio</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]" > <!--El accept es para restringir el tipo de archivo a enviar-->

    <?php if ($propiedad->imagen): ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-peque">
    <?php endif ?>
    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 7" min="1" value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 7" min="1" value="<?php echo s($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 7" min="1" value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
        <select name="propiedad[vendedores_id]">
            <option value="" disable selected>Seleccione un vendedor</option>
            <?php foreach($vendedores as $vendedor): ?>
                <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?> value="<?php echo s($vendedor->id); ?>"> <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></option>
            <?php endforeach ?>
        </select>
</fieldset>