<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create movie</title>
</head>
<body>
    <form action="/dashboard/pelicula/create" method="post">
        <?= view('/dashboard/pelicula/include/form',['op' => 'Create']); ?>
    </form>
    <p><a href="/dashboard/pelicula">back</a></p>
</body>
</html>