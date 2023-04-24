<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('header-title') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
</head>
<body>    
    <nav class="navbar navbar-expand-lg bg-primary mb-4" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">Code4</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>/dashboard/categoria">Categoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>/dashboard/pelicula">Peliculas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>/dashboard/etiqueta">Etiquetas</a>
                    </li>
                </ul>                
                <a class="btn btn-danger" href="<?= route_to('usuario.logout') ?>">Logout</a>                
            </div>
        </div>
    </nav>

    <div class="container">
        <?= view('partials/session'); ?>
        <div class="card">
            <div class="card-header">
                <?= $this->renderSection('title') ?>
            </div>
            <div class="card-body">
                <?= $this->renderSection('contenido') ?>
            </div>
        </div>
    </div>    
    <script src="<?= base_url() ?>/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>