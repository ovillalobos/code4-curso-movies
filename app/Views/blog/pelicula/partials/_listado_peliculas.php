<div class="overflow-y-auto mb-3" style="height: 800px;">
    <?php foreach( $peliculas as $p ): ?>
    <div class="card mb-3">
        <div class="card-body">
            <?php if($p->imagen): ?>
                <img class="w-25" src="/uploads/peliculas/<?= $p->imagen ?>" alt="<?= $p->title ?>">
            <?php endif ?>
            
            <h4><?= $p->title ?></h4>
            <h5>Categorias</h5>
            <a href="<?= route_to('blog.pelicula.indexByCategoria', $p->categoria_id)?>" class="btn btn-sm btn-info mb-2"><?= $p->categoria ?></a>
            <p><?= $p->description ?></p>

            <?php  
                if($p->etiquetas){
                    $etiquetas = "";
                    $array_etiquetas = explode(",", $p->etiquetas);
                    for($i=0 ; $i<sizeof($array_etiquetas) ; $i++){  
                        $etiquetas .= '<span class="btn btn-sm btn-warning">'.$array_etiquetas[$i].'</span>';
                    }
                    echo '<h5>Etiquetas</h5>';
                    echo '<div class="d-flex gap-2">'.$etiquetas.'</div>';
                }
            ?>
            <hr>
            <div class="d-flex flex-row justify-content-start">
                <!-- <a href="/blog/<?= $p->id ?>" class="btn btn-primary">Ver...</a> -->
                <a class="btn btn-primary" href="<?= route_to('blog.pelicula.show', $p->id) ?>">Ver...</a>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>
<?= $pager->links() ?>