<?php ob_start() ?>

blabla 

<?php $content = ob_get_clean(); ?> 

<?php require(APP_VIEW . 'template.php'); ?>