<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Categoria - listado
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Listado de categorias
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <a href="<?= route_to('usuario.logout') ?>">Logout</a> | <a href="/dashboard/categoria/new/">Create</a>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Options</th>
        </tr>
        <?php foreach ($categorias as $key => $categoria): ?>
            <tr>
                <td><?= $categoria->id; ?></td>
                <td><?= $categoria->title; ?></td>
                <td>
                    <a href="/dashboard/categoria/show/<?= $categoria->id ?>">Show</a>
                    <a href="/dashboard/categoria/edit/<?= $categoria->id ?>">Edit</a>
                    <form action="/dashboard/categoria/delete/<?= $categoria->id ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>    

    <?= view('/dashboard/categoria/include/footer',['option' => 'pelicula']); ?>
<?= $this->endSection() ?>