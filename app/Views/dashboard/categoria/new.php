<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Categoria - crear
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Crear categoria
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <form action="/dashboard/categoria/create" method="post">
        <?= view('/dashboard/categoria/include/form',['op' => 'Create']); ?>
    </form>        
    <?= view('/dashboard/categoria/include/footer',['option' => 'back']); ?>
<?= $this->endSection() ?>