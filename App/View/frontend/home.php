<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div clas="inline-block">
            <h4>Listes des articles</h4>
        </div>
        <hr/>
        <div class="center-align article-list">
            <?php foreach($data as $value): ?>
                <div class="row">
                    <div class="title"><h2><?= $value->title ?></h2></div>
                    <?php
                    echo "<p>Article n°" . $value->id . " écrit le " . $value->date_create . " par ". $value->name .".</p>";
                    if($value->date_update != NULL) {
                        echo "<p>Date de la dernière mise à jour : ".$value->date_update."</p>";
                    }
                    ?>
                    <div class="text-justify"><hr/><?= html_entity_decode(trim(substr($value->contains,0,600),'"')) ?></div>
                    <div><a href="/posts/<?= $value->id ?>" class="float-left">Lire la suite</a></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php $body = ob_get_clean(); ?>

<?php require(ROOT . '/App/View/layout.php'); ?>

