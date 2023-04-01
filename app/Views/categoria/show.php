<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('/categoria/include/header',['title' => 'Categoria - '.$categoria['title'] ]); ?>
</head>
<body>
    <h1>Category</h1>
    <p><?= $categoria['title']; ?></p>
    <?= view('/categoria/include/footer',['option' => 'back']); ?>
</body>
</html>