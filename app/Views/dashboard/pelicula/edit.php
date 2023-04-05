<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('/partials/header',['title' => 'Peliculas']); ?>
</head>
<body>
    <h1>Editar pelicula</h1>
    <form action="/dashboard/pelicula/update/<?= $pelicula['id']; ?>" method="post">
        <?= view('/dashboard/pelicula/include/form',['op' => 'Update']); ?>
    </form>

    <?= view('/dashboard/pelicula/include/footer',['option' => 'back']); ?>
</body>
</html>