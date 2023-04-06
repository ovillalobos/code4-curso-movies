<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Pelicula - <?= $pelicula->title ?>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Mostrar pelicula
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <h1><?= $pelicula->title ?></h1>
    <p><?= $pelicula->description ?></p>

    <?= view('/dashboard/pelicula/include/footer',['option' => 'back']); ?>
<?= $this->endSection() ?>