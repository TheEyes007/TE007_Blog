<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="contain text-center">
<h1>Erreur 404</h1>
<p>
La page et l'url que vous choisissez n'existe pas.
</p>
</div>

<?php $body = ob_get_clean(); ?>
<?php require(ROOT . '/Core/Router//View/layout.php'); ?>