<table>
    <tr valign="top">
        <td><label for="title">Title</label></td>
        <td><input type="text" name="title" id="title" value="<?= old('title',$etiqueta->title); ?>" placeholder="Title"></td>
    </tr>
    <tr valign="top">
        <td><label for="categoria_id">Categorias</label></td>
        <td><select name="categoria_id" id="categoria_id">
            <option value=""></option>
            <?php foreach ($categorias as $categoria): ?>
                <option <?= $categoria->id !== old('categoria_id', $etiqueta->categoria_id) ? '': 'selected' ?> value="<?= $categoria->id ?>"><?= $categoria->title ?></option>
            <?php endforeach ?>
        </select></td>
    </tr>
</table>
<button type="submit"><?= $op; ?></button>