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

    <h3>Categoria</h3>
    <p><?= $pelicula->categoria ?></p>

    <?php if(isset($imagenes) && $imagenes!= null):?>
        <h3>Imagenes</h3>
        <ul>
            <?php foreach($imagenes as $imagen): ?>
                <li>
                    <img src="/uploads/peliculas/<?= $imagen->imagen ?>" alt="<?= $imagen->data ?>" width="200px">
                    <form action="<?= route_to('pelicula.delete_image', $pelicula->id, $imagen->id)?>" method="post">
                        <button class="btn btn-danger" type="submit">Borrar</button>
                    </form>
                    <form action="<?= route_to('pelicula.download_file', $imagen->id)?>" method="get">
                        <button class="btn btn-primary" type="submit">Download</button>
                    </form>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <h3>Etiquetas</h3>
    <?php foreach($etiquetas as $etiqueta): ?>        
        <button data-url='<?= route_to('pelicula.etiqueta_delete', $pelicula->id, $etiqueta->id) ?>' class="delete_etiqueta btn btn-primary"><?= $etiqueta->title ?></button>
    <?php endforeach ?>

    <script>
    document.querySelectorAll('.delete_etiqueta').forEach((b) => {
        //b.getAttribute('data-url'))
        b.onclick = function (event) {
            fetch(this.getAttribute('data-url'), {
                method:'POST'
            }).then(res => console.log(res))
            .then(res => {
                window.location.reload();
                console.log(res);
            })
        }
    });
    </script>
<?= $this->endSection() ?>