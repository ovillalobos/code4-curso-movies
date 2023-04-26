<?= $this->extend('layouts/blog') ?>

<?= $this->section('contenido') ?>
    <h1>Pelicula por Etiqueta</h1>
    <div class="d-flex justify-content-between">
        <h5><?= $etiqueta->title ?></h5>
        <a href="<?= route_to('blog.pelicula.index') ?>" class="btn btn-sm btn-primary">Regresar</a>
    </div>
    <hr>    

    <?= view('blog/pelicula/partials/_listado_peliculas') ?>

<?= $this->endSection() ?>