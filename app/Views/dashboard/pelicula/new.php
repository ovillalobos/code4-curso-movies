<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('/partials/header',['title' => 'Peliculas']); ?>
</head>
<body>
    <h1>Crear pelicula</h1>
    <form action="/dashboard/pelicula/create" method="post">
        <?= view('/dashboard/pelicula/include/form',['op' => 'Create']); ?>
    </form>

    <?= view('/dashboard/pelicula/include/footer',['option' => 'back']); ?>
</body>
</html>