<?php

use App\Form\PostsForm;

$title = 'Backoffice - Ajouter un chapitre';
$form = new PostsForm();
$comments_form = $form->NewPost();


ob_start();
?>
<div class="container">
    <div class="row">
        <h4 class="edit-new-posts">Ajouter un chapitre</h4>
        <hr/>
        <div class="form-group center-align">
            <form method="POST" action="" >
                <?php
                foreach ($comments_form as $value){
                    echo $value;
                }
                ?>
                <a class="btn btn-warning float-left" href="/backoffice">Retour</a>
            </form>
        </div>
    </div>
</div>

<?php
    $body = ob_get_clean();
    require(ROOT . '/App/View/layout.php');
?>

