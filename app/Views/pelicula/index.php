<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>
<body>
    <h1>Listado de peliculas</h1>
    <a href="/pelicula/new/">Create</a>
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
                    <a href="/pelicula/show/<?= $p['id'] ?>">Show</a>
                    <a href="/pelicula/edit/<?= $p['id'] ?>">Edit</a>
                    <form action="/pelicula/delete/<?= $p['id'] ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>