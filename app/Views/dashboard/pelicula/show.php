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

    <h3>Imagenes</h3>
    <ul>
        <?php foreach($imagenes as $imagen): ?>
            <li><?= $imagen->imagen.".".$imagen->extension." - ".$imagen->data ?></li>
        <?php endforeach ?>
    </ul>

    <h3>Etiquetas</h3>
    <?php foreach($etiquetas as $etiqueta): ?>        
        <button data-url='<?= route_to('pelicula.etiqueta_delete', $pelicula->id, $etiqueta->id) ?>' class="delete_etiqueta"><?= $etiqueta->title ?></button>
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
    <?= view('/dashboard/pelicula/include/footer',['option' => 'back']); ?>
<?= $this->endSection() ?>