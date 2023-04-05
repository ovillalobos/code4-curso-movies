<?= $this->extend('layouts/dashboard') ?>

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
        <?php foreach ($peliculas as $key => $p): ?>
            <tr>
                <td><?= $p['id']; ?></td>
                <td><?= $p['title']; ?></td>
                <td><?= $p['description']; ?></td>
                <td>
                    <a href="/dashboard/pelicula/show/<?= $p['id'] ?>">Show</a>
                    <a href="/dashboard/pelicula/edit/<?= $p['id'] ?>">Edit</a>
                    <form action="/dashboard/pelicula/delete/<?= $p['id'] ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <?= view('/dashboard/pelicula/include/footer',['option' => 'categoria']); ?>
<?= $this->endSection() ?>