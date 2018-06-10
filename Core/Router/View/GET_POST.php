<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Blog de Tartanpion</h1>
<p>
    La méthode GET/POST n'existe pas.
</p>

<?php $body = ob_get_clean(); ?>
<?php require(ROOT . '/Core/Router//View/layout.php'); ?>