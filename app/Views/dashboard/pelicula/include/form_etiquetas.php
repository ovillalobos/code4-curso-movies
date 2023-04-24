<form action="" method="post">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="categoria_id" class="form-label">Categorias</label>
            <select class="form-select" name="categoria_id" id="categoria_id">
                <option value=""></option>
                <?php foreach ($categorias as $categoria): ?>
                    <option <?= $categoria_id !== old('categoria_id', $categoria->id) ? '': 'selected' ?> value="<?= $categoria->id ?>"><?= $categoria->title ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="etiqueta_id" class="form-label">Etiquetas</label>
            <select name="etiqueta_id" id="etiqueta_id" class="form-select">
                <option value=""></option>
                <?php foreach ($etiquetas as $etiqueta): ?>
                    <option value="<?= $etiqueta->id ?>"><?= $etiqueta->title ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <button type="submit" id="send" class="btn btn-primary btn-sm">Enviar</button>
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