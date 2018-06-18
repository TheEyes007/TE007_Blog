<?php

$title = 'Mon blog';

ob_start();
?>
<div class="container">
    <div class="row inline-block">
        <h4 class="edit-new-posts">Article<a class="btn btn-warning float-right" href="/backoffice">Retour</a></h4>
        <hr/>
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
                    echo '<div class="text-justify"><hr/>'.html_entity_decode(trim($value->contains,'"')).'</div>';
                }
                ?>
    </div>
</div>
<?php
$body = ob_get_clean();
require(ROOT . '/App/View/layout.php');
?>