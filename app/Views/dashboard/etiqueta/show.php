<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Etiqueta - <?= $etiqueta->etiqueta_title ?>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Mostrar etiqueta
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <h1><?= $etiqueta->etiqueta_title ?></h1>
    <p><?= $etiqueta->etiqueta_categoria ?></p>
<?= $this->endSection() ?>