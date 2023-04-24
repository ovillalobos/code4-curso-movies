<?= $this->extend('layouts/web') ?>

<?= $this->section('header-title') ?>
    Login
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="container mt-5">
    <h1 class="text-center">CODE4.app</h1>
    <div class="card mx-auto d-block mt-5" style="max-width: 500px;">
        <div class="card-header">
            <h4 class="text-left">Login</h4>
        </div>
        <div class="card-body">
            <form action="<?= route_to('usuario.login_post') ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Usuario/Email</label>
                    <input type="text" name="email" id="email" value="" placeholder="Usuario/Email"  class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" value="" placeholder="Password"  class="form-control">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Iniciar</button>
                </div>
            </form>  
            
            <div class="mt-3 text-end">
                <a href="<?= route_to('usuario.register')?>">Registrar</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>