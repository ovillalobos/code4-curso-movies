<?= $this->extend('layouts/dashboard') ?>title

<?= $this->section('header-title') ?>
    Pelicula - listado
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Listado de pelicula
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <a href="<?= route_to('usuario.logout') ?>">Logout</a> | <a href="/dashboard/pelicula/new/">Create</a>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Categoria</th>
            <th>Options</th>
        </tr>
        <?php $count = 1; ?>
        <?php foreach ($peliculas as $key => $pelicula): ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $pelicula->title ?></td>
                <td><?= $pelicula->categoria ?></td>
                <td><?= $pelicula->description ?></td>
                <td>
                    <a href="/dashboard/pelicula/show/<?= $pelicula->id ?>">Show</a>
                    <a href="/dashboard/pelicula/edit/<?= $pelicula->id ?>">Edit</a>
                    <a href="<?= route_to('pelicula.etiquetas', $pelicula->id) ?>">Tags</a>

                    <form action="/dashboard/pelicula/delete/<?= $pelicula->id ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <?= view('/dashboard/pelicula/include/footer',['option' => 'categoria']); ?>
<?= $this->endSection() ?>