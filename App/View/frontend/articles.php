<?php

use App\Form\CommentsForm;

$title = 'Mon blog';
$form = new CommentsForm();
$comments_form = $form->NewComment();


ob_start();
?>
<div class="container">
    <div class="row inline-block">
        <div><a class="btn btn-warning float-right" href="/">Retour</a></div>
            <?php
                foreach ($data as $value) {
                    echo "<h1>" . $value->title . "</h1>";
                    echo "<p>Article n°" . $value->id . " écrit le " . $value->date_create . " par ". $value->name .".</p>";

                    if($value->date_update != NULL) {
                       echo "<p>Date de la dernière mise à jour : ".$value->date_update."</p>";
                    }
                    echo '<div class="text-justify"><hr/>'.html_entity_decode(trim($value->contains,'"')).'</div>';
                }
                ?>
    </div>
    <?php if(!empty($_SESSION)): ?>
    <div class="row inline-block">
        <h4 class="edit-new-posts">Laissez votre commentaire</h4>
        <hr/>
        <form method="POST" action="" >
            <?php
                    foreach ($comments_form as $value){
                        echo $value;
            }
            ?>
            <a class="btn btn-warning float-left" style="margin-right:3px;" href="/">Retour</a>
        </form>
    </div>
    <?php endif; ?>
    <br/>
    <div class="row inline-block">
        <h4 class="edit-new-posts">Liste des commentaires</h4>
        <hr/>
        <?php
            foreach ($data_comments as $value) {
                echo "<h5>" . $value->title . '<a href="comments/'. $value->id .'" class="btn btn-danger float-right" title="Signaler"><span class="glyphicon glyphicon-flag"></span></a></h5>';
                echo "<p>Commentaire n°" . $value->id . " écrit le " . $value->date_create . " par ". $value->name .".</p>";
                if($value->date_update != NULL) {
                    echo "<p>Date de la dernière mise à jour : ".$value->date_update."</p>";
                }
                echo '<br/><div class="text-justify">'.$value->contains.'</div><hr/>';
            }
        ?>
    </div>
</div>
<?php
$body = ob_get_clean();
require(ROOT . '/App/View/layout.php');
?>