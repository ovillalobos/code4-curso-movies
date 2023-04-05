<!DOCTYPE html>
<html lang="en">
    <head>
        <?= view('/partials/header',['title' => 'Create cateogory']); ?>
    </head>
    <body>
        <h1>Crear categoria</h1>
        <form action="/dashboard/categoria/create" method="post">
            <?= view('/dashboard/categoria/include/form',['op' => 'Create']); ?>
        </form>        
        <?= view('/dashboard/categoria/include/footer',['option' => 'back']); ?>
    </body>
</html>