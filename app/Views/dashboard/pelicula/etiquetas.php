<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Pelicula etiquetas - editar
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Editar Etiquetas
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>    
    <?= view('/dashboard/pelicula/include/form_etiquetas'); ?>
<?= $this->endSection() ?>