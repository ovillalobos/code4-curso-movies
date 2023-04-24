<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Pelicula - crear
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Crear pelicula
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <form action="/dashboard/pelicula/create" method="post">
        <?= view('/dashboard/pelicula/include/form',['op' => 'Create']); ?>
    </form>
<?= $this->endSection() ?>