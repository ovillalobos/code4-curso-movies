<?php if(session('validation')): ?>
    <div style="margin-bottom: 20px;">
        <?= session('validation')->listErrors() ?>
    </div>
<?php endif ?>

<?php if(session('mensaje')): ?>
    <div style="margin-bottom: 20px;">
        <?= session('mensaje') ?>
    </div>
<?php endif ?>