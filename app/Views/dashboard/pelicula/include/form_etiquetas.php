<form action="" method="post">
    <table>
        <tr valign="top">
            <td><label for="categoria_id">Categorias</label></td>
            <td><select name="categoria_id" id="categoria_id">
                <option value=""></option>
                <?php foreach ($categorias as $categoria): ?>
                    <option <?= $categoria_id !== old('categoria_id', $categoria->id) ? '': 'selected' ?> value="<?= $categoria->id ?>"><?= $categoria->title ?></option>
                <?php endforeach ?>
            </select></td>
        </tr>
        <tr valign="top">
            <td><label for="etiqueta_id">Etiquetas</label></td>
            <td><select name="etiqueta_id" id="etiqueta_id">
                <option value=""></option>
                <?php foreach ($etiquetas as $etiqueta): ?>
                    <option value="<?= $etiqueta->id ?>"><?= $etiqueta->title ?></option>
                <?php endforeach ?>
            </select></td>
        </tr>
    </table>
    <button type="submit" id="send">Enviar</button>
</form>

<script>
    function disableEnableButton()
    {
        if( document.querySelector('[name=etiqueta_id]').value == '' ){
            document.querySelector('#send').setAttribute('disabled', 'disabled');
        } else {
            document.querySelector('#send').removeAttribute('disabled', 'disabled');
        }
    }

    document.querySelector('[name=categoria_id]').onchange = function (event)
    {        
        window.location.href = '<?= route_to('pelicula.etiquetas', $pelicula->id) ?>?categoria_id='+this.value;
    }

    document.querySelector('[name=etiqueta_id]').onchange = function (event)
    {        
        disableEnableButton();
    }

    disableEnableButton();
</script>