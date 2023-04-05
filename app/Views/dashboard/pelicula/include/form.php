<table>
    <tr valign="top">
        <td><label for="title">Title</label></td>
        <td><input type="text" name="title" id="title" value="<?= old('title',$pelicula['title']); ?>" placeholder="Title"></td>
    </tr>
    <tr valign="top">
        <td><label for="description">Description</label></td>
        <td><textarea name="description" cols="30" rows="10" id="description"><?= old('description',$pelicula['description']); ?></textarea></td>
    </tr>            
</table>
<button type="submit"><?= $op; ?></button>