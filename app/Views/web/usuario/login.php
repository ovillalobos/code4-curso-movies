<?= $this->extend('layouts/web') ?>

<?= $this->section('header-title') ?>
    Login
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <form action="<?= route_to('usuario.login_post') ?>" method="post">
        <table>
            <tr valign="top">
                <td><label for="email">Usuario/Email</label></td>
                <td><input type="text" name="email" id="email" value="" placeholder="Usuario/Email"></td>
            </tr>
            <tr valign="top">
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password" value="" placeholder="Password"></td>
            </tr>
        </table>
        <button type="submit">Iniciar</button>
    </form>
<?= $this->endSection() ?>