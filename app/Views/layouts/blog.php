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
                        <a class="nav-link" href="#">Peliculas</a>
                    </li>                    
                </ul>                            
            </div>
        </div>
    </nav>

    <div class="container">
        <?= $this->renderSection('contenido') ?>
    </div>

    <script src="<?= base_url() ?>/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>