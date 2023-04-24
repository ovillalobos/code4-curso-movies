<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Pelicula - listado
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    <h1>Listado de pelicula</h1>
    <a href="/dashboard/pelicula/new/" class="btn btn-primary btn-sm">Create</a>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    

    <div class="table-responsive">
        <table class="table table-sm table-hover align-middle">
            <thead>
                <tr>
                    <th width="80px">#</th>
                    <th width="150px">Title</th>
                    <th width="150px">Categoria</th>
                    <th>Description</th>            
                    <th width="200px">Options</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($peliculas as $key => $pelicula): ?>
                    <tr>
                        <td><?= $pelicula->id ?></td>
                        <td><?= $pelicula->title ?></td>
                        <td><?= $pelicula->categoria ?></td>
                        <td><?= $pelicula->description ?></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-outline-primary btn-sm me-2" href="/dashboard/pelicula/show/<?= $pelicula->id ?>">Show</a>
                                <a class="btn btn-outline-primary btn-sm me-2" href="/dashboard/pelicula/edit/<?= $pelicula->id ?>">Edit</a>
                                <a class="btn btn-outline-primary btn-sm me-2" href="<?= route_to('pelicula.etiquetas', $pelicula->id) ?>">Tags</a>
                                <form action="/dashboard/pelicula/delete/<?= $pelicula->id ?>" method="post">
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