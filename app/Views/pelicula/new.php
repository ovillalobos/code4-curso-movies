<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create movie</title>
</head>
<body>
    <form action="/pelicula/create" method="post">
        <?= view('/pelicula/_form',['op' => 'Create']); ?>
    </form>
    <p><a href="/pelicula">back</a></p>
</body>
</html>