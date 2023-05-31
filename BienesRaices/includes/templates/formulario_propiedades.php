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
<!-- <select name="vendedores_id">
    <option value="" disabled selected>Seleccione un vendedor</option> -->
    <?php /* //Agregando vendedores desde la bd
    while ($vendedor = mysqli_fetch_assoc($resultado)): */?>
    
    <!--Itera sobre la base de datos y revisa que si el atributo seleccionado es igual al que está en la base de datos y si es asi lo conserva
    y agrega el atributo de selected en html-->
    <!-- <option <?php echo $vendedores_id === $vendedor["id"] ? "selected" : ""; ?> value="<?php echo $propiedad->vendedor["id"]; ?>"><?php echo $propiedad->vendedor["nombre"] . " " . $propiedad->vendedor["apellido"]; ?></option> -->

    <?php //endwhile ?>
</select>
</fieldset>