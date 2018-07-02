<?php $title = 'Jean Forteroche, blog, Alaska'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="center-align article-list">
            <?php foreach($data as $value): ?>
                <div class="row">
                    <div class="title"><h2><?= $value->title ?></h2></div>
                    <?php
                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_create);
                    echo "<p>Chapitre écrit le " . date_format($date,'d/m/Y H:i:s') . " par ". $value->name .".</p>";
                    if($value->date_update != NULL) {
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_update);
                        echo "<p>Date de la dernière mise à jour : ".date_format($date,'d/m/Y H:i:s')."</p>";
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

