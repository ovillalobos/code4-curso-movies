<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('header-title') ?>
    Pelicula - editar
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Editar pelicula
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <!-- enctype="multipart/form-data" => ES NECESARIO PARA SUBIR ARCHIVOS -->
    <form enctype="multipart/form-data" action="/dashboard/pelicula/update/<?= $pelicula->id; ?>" method="post">
        <?= view('/dashboard/pelicula/include/form',['op' => 'Update']); ?>
    </form>

    <?= view('/dashboard/pelicula/include/footer',['option' => 'back']); ?>
<?= $this->endSection() ?>