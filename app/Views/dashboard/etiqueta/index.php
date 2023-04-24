<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Etiqueta - listado
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    <h1>Listado de etiqueta</h1>
    <a href="/dashboard/etiqueta/new/" class="btn btn-primary btn-sm">Create</a>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    

    <div class="table-responsive">
        <table class="table table-sm table-hover align-middle">
            <thead>
                <tr>
                    <th width="80px">#</th>
                    <th width="150px">Title</th>
                    <th>Categoria</th>
                    <th width="200px">Options</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($etiquetas as $key => $etiqueta): ?>
                    <tr>
                        <td><?= $etiqueta->etiqueta_id ?></td>
                        <td><?= $etiqueta->etiqueta_title ?></td>
                        <td><?= $etiqueta->etiqueta_categoria ?></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-outline-primary btn-sm me-2" href="/dashboard/etiqueta/show/<?= $etiqueta->etiqueta_id ?>">Show</a>
                                <a class="btn btn-outline-primary btn-sm me-2" href="/dashboard/etiqueta/edit/<?= $etiqueta->etiqueta_id ?>">Edit</a>
                                <form action="/dashboard/etiqueta/delete/<?= $etiqueta->etiqueta_id ?>" method="post">
                                    <button class="btn btn-outline-danger btn-sm me-2" type="submit">Delete</button>
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