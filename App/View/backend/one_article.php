<?php

$title = 'Mon blog';

ob_start();
?>
<div class="container">
    <div class="row inline-block">
            <?php
                foreach ($data as $value) {
                    echo "<h4>" . $value->title . "<a class=\"btn btn-warning float-right\" href=\"/backoffice\">Retour</a></h4><hr/>";
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_create);
                        echo "<p>Article écrit le " . date_format($date,'d/m/Y H:i:s') . " par ". $value->name ."</p>";
                    if($value->date_update != NULL) {
                         $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_update);
                         echo "<p>Date de la dernière mise à jour : ".date_format($date,'d/m/Y H:i:s')."</p>";
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