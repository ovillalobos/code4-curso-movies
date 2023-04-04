<!DOCTYPE html>
<html lang="en">
    <head>
        <?= view('/dashboard/categoria/include/header',['title' => 'Update cateogory']); ?>
    </head>
    <body>
        <h1>Create category</h1>
        <form action="/dashboard/categoria/update/<?= $categoria['id']; ?>" method="post">
            <?= view('/dashboard/categoria/include/form',['op' => 'Update']); ?>
        </form>        
        <?= view('/dashboard/categoria/include/footer',['option' => 'back']); ?>
    </body>
</html>