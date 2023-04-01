<!DOCTYPE html>
<html lang="en">
    <head>
        <?= view('/categoria/include/header',['title' => 'Create cateogory']); ?>
    </head>
    <body>
        <h1>Create category</h1>
        <form action="/categoria/create" method="post">
            <?= view('/categoria/include/form',['op' => 'Create']); ?>
        </form>        
        <?= view('/categoria/include/footer',['option' => 'back']); ?>
    </body>
</html>