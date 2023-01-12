<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>

<p>Page home</p>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>