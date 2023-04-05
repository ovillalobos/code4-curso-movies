<!DOCTYPE html>
<html lang="es">
    <head>
        <?= view('/partials/header',['title' => 'Categorias']); ?>
    </head>
    <body>
        <h1>Listado de categorias</h1>

        <?= view('partials/session'); ?>

        <a href="/dashboard/categoria/new/">Create</a>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Options</th>
            </tr>
            <?php foreach ($categoria as $key => $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= $p['title']; ?></td>
                    <td>
                        <a href="/dashboard/categoria/show/<?= $p['id'] ?>">Show</a>
                        <a href="/dashboard/categoria/edit/<?= $p['id'] ?>">Edit</a>
                        <form action="/dashboard/categoria/delete/<?= $p['id'] ?>" method="post">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>    

        <?= view('/dashboard/categoria/include/footer',['option' => 'pelicula']); ?>
    </body>
</html>