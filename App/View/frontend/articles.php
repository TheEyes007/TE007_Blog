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
                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_create);
                    echo "<p>Article écrit le " . date_format($date,'d/m/Y H:i:s') . " par ". $value->name .".</p>";

                    if($value->date_update != NULL) {
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_update);
                       echo "<p>Date de la dernière mise à jour : ".date_format($date,'d/m/Y H:i:s')."</p>";
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
    <?php else: ?>
    <div class="row inline-block">
        <h4 class="edit-new-posts">Vous devez être inscrits pour <b>signaler</b> ou <b>laisser</b> votre commentaire</h4>
        <hr/>
    </div>
    <?php endif; ?>
    <br/>
    <div class="row inline-block">
        <h4 class="edit-new-posts">Liste des commentaires</h4>
        <hr/>
        <?php
                    foreach ($data_comments as $value) {
                        if (!empty($_SESSION)) {
                            if($value->alert === '0') {
                                echo "<h5>" . $value->title . '<a href="comments/' . $value->id . '" class="btn btn-default float-right" title="Signaler"><span class="glyphicon glyphicon-flag black-glyphicon"></span></a></h5>';
                            } else{
                                echo "<h5>" . $value->title . '<a class="btn btn-warning float-right comments-warning" title="Commentaire déjà signalé"><span class="glyphicon glyphicon-alert"></span></a><a href="comments/' . $value->id . '" class="btn btn-default float-right" title="Signaler"><span class="glyphicon glyphicon-flag black-glyphicon"></span></a></h5>';
                            }


                        }
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_create);
                        echo "<p>Commentaire n° écrit le " . date_format($date,'d/m/Y H:i:s') . " par ". $value->name .".</p>";
                        if($value->date_update != NULL) {
                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_update);
                            echo "<p>Date de la dernière mise à jour : ".date_format($date,'d/m/Y H:i:s')."</p>";
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