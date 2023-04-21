<?= $this->extend('layouts/dashboard') ?>title

<?= $this->section('header-title') ?>
    Etiqueta - listado
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Listado de etiqueta
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <a href="<?= route_to('usuario.logout') ?>">Logout</a> | <a href="/dashboard/etiqueta/new/">Create</a>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Categoria</th>
            <th>Options</th>
        </tr>
        <?php $count = 1; ?>
        <?php foreach ($etiquetas as $key => $etiqueta): ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $etiqueta->etiqueta_title ?></td>
                <td><?= $etiqueta->etiqueta_categoria ?></td>
                <td>
                    <a href="/dashboard/etiqueta/show/<?= $etiqueta->etiqueta_id ?>">Show</a>
                    <a href="/dashboard/etiqueta/edit/<?= $etiqueta->etiqueta_id ?>">Edit</a>
                    <form action="/dashboard/etiqueta/delete/<?= $etiqueta->etiqueta_id ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    
    <?= $pager->links() ?>

    <?= view('/dashboard/etiqueta/include/footer',['option' => 'categoria']); ?>
<?= $this->endSection() ?>