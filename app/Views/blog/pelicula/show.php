<?= $this->extend('layouts/blog') ?>

<?= $this->section('contenido') ?>
    <div class="card">
        <div class="card-header align-items-center d-flex justify-content-between">
            <div class="title">
                Mostrar <strong>detalles</strong> de la pelicula <strong><?= $pelicula->title ?></strong>
            </div>
            <div class="button">
                <a class="btn btn-primary" href="<?= route_to('blog.pelicula.index') ?>">Regresar</a>
            </div>
        </div>

        <div class="card-body">
            <h1><?= $pelicula->title ?></h1>
            <a href="<?= route_to('blog.pelicula.indexByCategoria', $pelicula->categoria_id ) ?>" class="btn btn-primary mb-3"><?= $pelicula->categoria ?></a>
            <p><?= $pelicula->description ?></p>    

            <?php if(isset($imagenes) && $imagenes!= null):?>
            <h3>Imagenes</h3>
            <div class="d-flex gap-3 mt-3 mb-3">
                <?php foreach($imagenes as $imagen): ?>
                    <img src="/uploads/peliculas/<?= $imagen->imagen ?>" alt="<?= $imagen->data ?>" class="w-25 shadow p-3 rounded-3">
                <?php endforeach ?>
            </div>
            <?php endif ?>

            <h4>Etiquetas</h4>
            <div class="d-flex gap-3 mt-3 mb-3">
                <?php foreach($etiquetas as $etiqueta): ?>        
                    <a href="<?= route_to('blog.pelicula.indexByEtiqueta', $etiqueta->id) ?>" class="btn btn-warning btn-sm"><?= $etiqueta->title ?></a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>