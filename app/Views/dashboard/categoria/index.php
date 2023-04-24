<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Categoria - listado
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    <h1>Listado de categorias</h1>
    <a href="/dashboard/categoria/new/" class="btn btn-primary btn-sm">Create</a>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <div class="table-responsive">
        <table class="table table-sm table-hover align-middle">
            <thead>
                <tr>
                    <th width="80px">#</th>
                    <th>Title</th>
                    <th width="200px">Options</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($categorias as $key => $categoria): ?>
                    <tr>
                        <td><?= $categoria->id; ?></td>
                        <td><?= $categoria->title; ?></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-outline-primary btn-sm me-2" href="/dashboard/categoria/show/<?= $categoria->id ?>">Show</a>
                                <a class="btn btn-outline-primary btn-sm me-2" href="/dashboard/categoria/edit/<?= $categoria->id ?>">Edit</a>
                                <form action="/dashboard/categoria/delete/<?= $categoria->id ?>" method="post">
                                    <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>    
    </div>
    <?= $pager->links() ?>
    
<?= $this->endSection() ?>