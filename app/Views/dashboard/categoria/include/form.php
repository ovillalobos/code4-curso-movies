<div class="row">
    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="<?= old('title',$categoria->title); ?>" placeholder="Title">
    </div>
</div>
<button type="submit" class="btn btn-primary btn-sm"><?= $op; ?></button>