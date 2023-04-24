<?php if(session('validation')): ?>    
        <?php if(session('error_tipo')): ?>
            <?php 
            $class = "";
            switch(session('error_tipo')){
                case 'error': $class = "alert-danger"; break;
                case 'success': $class = "alert-primary"; break;
                case 'warning': $class = "alert-warning"; break;
            } ?>

            <div class="alert <?= $class ?> alert-dismissible fade show" role="alert">
                <ul>
                    <?php foreach( session('validation')->getErrors() as $error): ?>
                        <?= '<li>'.$error.'</li>' ?>
                    <?php endforeach ?>
                </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?php else: ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <?= session('validation')->listErrors() ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?php endif ?>        
    </div>
<?php endif ?>

<?php if(session('mensaje')): ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <?= session('mensaje') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>