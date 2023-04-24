<div class="row">
    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= old('title',$pelicula->title); ?>" placeholder="Title">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" cols="30" rows="10" id="description"><?= old('description',$pelicula->description); ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="categoria_id" class="form-label">Categorias</label>
        <select class="form-select" name="categoria_id" id="categoria_id">
            <option value=""></option>
            <?php foreach ($categorias as $categoria): ?>
                <option <?= $categoria->id !== old('categoria_id', $pelicula->categoria_id) ? '': 'selected' ?> value="<?= $categoria->id ?>"><?= $categoria->title ?></option>
            <?php endforeach ?>
        </select>
    </div> 
</div>
<?php if($pelicula->id): ?>
    <div class="row">
        <div class="col-md-6 mb-3">                   
            <label for="imagen">Imagen</label  class="form-label">
            <input type="file" class="form-control" name="imagen" id="imagen">
        </div>  
    </div>
<?php endif ?>         

<button type="submit" class="btn btn-primary btn-sm"><?= $op; ?></button>