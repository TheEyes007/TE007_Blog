<?php

$title = 'Mon blog';

ob_start();
?>
<div class="container">
    <div class="row inline-block">
            <?php
                foreach ($data as $value) {
                    echo '<h4 class="edit-new-posts">'.$value->title_comments.'<a class="btn btn-warning float-right" href="/myaccount/comments">Retour</a></h4><hr/>';
                    echo "<p>Commentaire n°" . $value->id . " écrit le " . $value->date_create . " par ". $value->name .".</p>";
                    if($value->date_update != NULL) {
                       echo "<p>Date de la dernière mise à jour : ".$value->date_update."</p>";
                    }
                    echo '<div class="text-justify"><hr/>'.html_entity_decode(trim($value->contains,'"')).'</div>';
                }
                ?>
    </div>
</div>
<?php $body = ob_get_clean(); require(ROOT . '/Core/ManageUser/Views/layout.php'); ?>