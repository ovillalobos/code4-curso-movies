<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Categoria - editar
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Editar categoria
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <form action="/dashboard/categoria/update/<?= $categoria->id ?>" method="post">
        <?= view('/dashboard/categoria/include/form',['op' => 'Update']); ?>
    </form>        
<?= $this->endSection() ?>