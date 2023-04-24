<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Etiqueta - editar
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Editar etiqueta
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <form action="/dashboard/etiqueta/update/<?= $etiqueta->id; ?>" method="post">
        <?= view('/dashboard/etiqueta/include/form',['op' => 'Update']); ?>
    </form>
<?= $this->endSection() ?>