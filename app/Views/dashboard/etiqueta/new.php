<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Etiqueta - crear
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Crear etiqueta
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <form action="/dashboard/etiqueta/create" method="post">
        <?= view('/dashboard/etiqueta/include/form',['op' => 'Create']); ?>
    </form>
<?= $this->endSection() ?>