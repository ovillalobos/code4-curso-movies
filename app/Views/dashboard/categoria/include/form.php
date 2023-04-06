<table>
    <tr valign="top">
        <td><label for="title">Title</label></td>
        <td><input type="text" name="title" id="title" value="<?= old('title',$categoria->title); ?>" placeholder="Title"></td>
    </tr>
</table>
<button type="submit"><?= $op; ?></button>