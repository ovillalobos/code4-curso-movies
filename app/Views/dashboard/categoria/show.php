<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Categoria - <?= $categoria->title ?>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Mostrar categoria
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <p><?= $categoria->title ?></p>
<?= $this->endSection() ?>