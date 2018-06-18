<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div clas="inline-block">
            <h4>Listes des articles
                <a class="btn btn-success float-right" href="/backoffice/add">Nouveau article</a>
            </h4>
        </div>
        <hr/>
        <div class="center-align">
            <?php
            foreach ($data as $value) {
                echo "<h2>" . $value->title . "</h2>";
                if ($value->fk_user === '1') {
                    echo "<p>Article n°" . $value->id . " écrit le " . $value->date_create . " par Administrateur.</p>";
                } else {
                    echo "<p>Article n°" . $value->id . " écrit le " . $value->date_create . " par Anonyme.</p>";
                }
                if($value->date_update != NULL) {
                    echo "<p>Date de la dernière mise à jour : ".$value->date_update."</p>";
                }
                echo '<div class="text-justify"><hr/>'.html_entity_decode(trim(substr($value->contains,0,600),'"')).'</div>';
                echo '<a href=/posts/'.$value->id.' class="float-left">Lire la suite</a>';
            }
            ?>

        </div>
    </div>
</div>

<?php $body = ob_get_clean(); ?>

<?php require(ROOT . '/App/View/layout.php'); ?>

