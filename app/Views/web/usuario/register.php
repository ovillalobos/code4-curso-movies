<?= $this->extend('layouts/web') ?>

<?= $this->section('header-title') ?>
    Login
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <form action="<?= route_to('usuario.register_post') ?>" method="post">
        <table>
            <tr valign="top">
                <td><label for="usuario">Usuario</label></td>
                <td><input type="text" name="usuario" id="usuario" value="" placeholder="Usuario"></td>
            </tr>
            <tr valign="top">
                <td><label for="email">Email</label></td>
                <td><input type="text" name="email" id="email" value="" placeholder="Email"></td>
            </tr>
            <tr valign="top">
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password" value="" placeholder="Password"></td>
            </tr>
        </table>
        <button type="submit">Iniciar</button>
    </form>
<?= $this->endSection() ?>