<div class="row">
    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" value="<?= old('title',$etiqueta->title); ?>" placeholder="Title"  class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="categoria_id" class="form-label">Categorias</label>
        <select name="categoria_id" id="categoria_id" class="form-select">
            <option value=""></option>
            <?php foreach ($categorias as $categoria): ?>
                <option <?= $categoria->id !== old('categoria_id', $etiqueta->categoria_id) ? '': 'selected' ?> value="<?= $categoria->id ?>"><?= $categoria->title ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<button type="submit" class="btn btn-primary btn-sm"><?= $op; ?></button>