<?= $this->extend('layouts/dashboard') ?>title

<?= $this->section('header-title') ?>
    Pelicula - listado
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Listado de pelicula
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <a href="/dashboard/pelicula/new/">Create</a>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Options</th>
        </tr>
        <?php foreach ($peliculas as $key => $pelicula): ?>
            <tr>
                <td><?= $pelicula->id ?></td>
                <td><?= $pelicula->title ?></td>
                <td><?= $pelicula->description ?></td>
                <td>
                    <a href="/dashboard/pelicula/show/<?= $pelicula->id ?>">Show</a>
                    <a href="/dashboard/pelicula/edit/<?= $pelicula->id ?>">Edit</a>
                    <form action="/dashboard/pelicula/delete/<?= $pelicula->id ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <?= view('/dashboard/pelicula/include/footer',['option' => 'categoria']); ?>
<?= $this->endSection() ?>