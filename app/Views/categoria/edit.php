<!DOCTYPE html>
<html lang="en">
    <head>
        <?= view('/categoria/include/header',['title' => 'Update cateogory']); ?>
    </head>
    <body>
        <h1>Create category</h1>
        <form action="/categoria/update/<?= $categoria['id']; ?>" method="post">
            <?= view('/categoria/include/form',['op' => 'Update']); ?>
        </form>        
        <?= view('/categoria/include/footer',['option' => 'back']); ?>
    </body>
</html>