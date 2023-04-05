<!DOCTYPE html>
<html lang="en">
    <head>
        <?= view('/partials/header',['title' => 'Update cateogory']); ?>
    </head>
    <body>
        <h1>Editar categoria</h1>
        <form action="/dashboard/categoria/update/<?= $categoria['id']; ?>" method="post">
            <?= view('/dashboard/categoria/include/form',['op' => 'Update']); ?>
        </form>        
        <?= view('/dashboard/categoria/include/footer',['option' => 'back']); ?>
    </body>
</html>