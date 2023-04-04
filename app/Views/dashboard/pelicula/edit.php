<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update movie</title>
</head>
<body>
    <form action="/dashboard/pelicula/update/<?= $pelicula['id']; ?>" method="post">
        <?= view('/dashboard/pelicula/include/form',['op' => 'Update']); ?>
    </form>
    <p><a href="/dashboard/pelicula">back</a></p>
</body>
</html>