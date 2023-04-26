<?= $this->extend('layouts/blog') ?>

<?= $this->section('contenido') ?>
    <h1>Pelicula por Categoria</h1>
    <hr>

    <div class="card mb-3 text-bg-primary">
        <div class="card-body">            
            <form action="" method="get">
                <div class="d-flex mb-3 gap-3">
                    <select class="form-select" name="categoria_id" id="categoria_id">
                        <option value=""></option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option <?= $categoria->id !== old('categoria_id', $oldData->categoriaId) ? '': 'selected' ?> value="<?= $categoria->id ?>"><?= $categoria->title ?></option>
                        <?php endforeach ?>
                    </select>
                    <select class="form-select" name="etiqueta_id" id="etiqueta_id">
                        <option value=""></option>   
                        <?php foreach ($etiquetas as $etiqueta): ?>
                            <option <?= $etiqueta->id !== old('etiqueta_id', $oldData->etiquetaId) ? '': 'selected' ?> value="<?= $etiqueta->id ?>"><?= $etiqueta->title ?></option>
                        <?php endforeach ?>                     
                    </select>
                </div>
                <div class="d-flex gap-3">            
                    <input class="form-control" type="text" name="buscar" value="<?= old('buscar',$oldData->buscar); ?>" placeholder="buscar...">
                    <input class="btn btn-warning" type="submit" value="Enviar">        
                    <a style="width: 160px;" class="btn btn-light" href="<?= route_to('blog.pelicula.index') ?>">Limpiar filtro</a>
                </div>
            </form>
        </div>
    </div>

    <?= view('blog/pelicula/partials/_listado_peliculas') ?>

    <script>
    function disableEnableButton()
    {
        if( document.querySelector('[name=categoria_id]').value == '' ){
            document.querySelector('[name=etiqueta_id]').setAttribute('disabled', 'disabled');
        } else {
            document.querySelector('[name=etiqueta_id]').removeAttribute('disabled', 'disabled');
        }
    }

    async function fetchRequest(urlRequest) {
        try {
            let response = await fetch(urlRequest);

            if(response.status === 200){
                let data = await response.json();
                let etiquetas = '<option value=""></option>';
                data.forEach((e)=>{
                    etiquetas += `<option value="${e.id}">${e.title}</option>`;
                });

                document.getElementById('etiqueta_id').innerHTML = etiquetas;
            }
        } catch (error) {
            console.log(error);
        }
    }


    //document.querySelector('#categoria_id').onchange = function (event)
    document.getElementById('categoria_id').addEventListener('change', () => {        
        disableEnableButton();

        var categoriaId = document.getElementById('categoria_id').value;
        var urlRequest = '/blog/etiquetasByCategoria/'+categoriaId;     
        
        fetchRequest(urlRequest);
        /* fetch(urlRequest)
        .then(response => response.json())
        .then(response => { console.log(response); })
        .catch(error => { console.error(error); }); */

    });

    disableEnableButton();
    </script>

<?= $this->endSection() ?>