<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="contain text-center">
<h1>Securité</h1>
<p>
    L'administrateur ne peut pas supprimer son compte.
</p>
</div>

<?php $body = ob_get_clean(); ?>
<?php require(ROOT . '/Core/Router//View/layout.php'); ?>