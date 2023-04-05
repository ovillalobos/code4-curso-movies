<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('/partials/header',['title' => 'Pelicula - '. $pelicula['title']]); ?>
</head>
<body>
    <h1><?= $pelicula['title']; ?></h1>
    <p><?= $pelicula['description']; ?></p>

    <?= view('/dashboard/pelicula/include/footer',['option' => 'back']); ?>
</body>
</html>