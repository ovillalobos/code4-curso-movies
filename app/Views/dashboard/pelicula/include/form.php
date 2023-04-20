<table>
    <tr valign="top">
        <td><label for="title">Title</label></td>
        <td><input type="text" name="title" id="title" value="<?= old('title',$pelicula->title); ?>" placeholder="Title"></td>
    </tr>
    <tr valign="top">
        <td><label for="description">Description</label></td>
        <td><textarea name="description" cols="30" rows="10" id="description"><?= old('description',$pelicula->description); ?></textarea></td>
    </tr>            
    <tr valign="top">
        <td><label for="categoria_id">Categorias</label></td>
        <td><select name="categoria_id" id="categoria_id">
            <option value=""></option>
            <?php foreach ($categorias as $categoria): ?>
                <option <?= $categoria->id !== old('categoria_id', $pelicula->categoria_id) ? '': 'selected' ?> value="<?= $categoria->id ?>"><?= $categoria->title ?></option>
            <?php endforeach ?>
        </select></td>
    </tr>     
    <?php if($pelicula->id): ?>
        <tr valign="top">        
            <td><label for="imagen">Imagen</label></td>
            <td><input type="file" name="imagen" id="imagen"></td>
        </tr>   
    <?php endif ?>         
</table>
<button type="submit"><?= $op; ?></button>