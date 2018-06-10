<?php

use App\Form\PostsForm;

$title = 'Mon blog';
$form = new PostsForm();
$comments_form = $form->NewComment();


ob_start();
?>
<div class="container">
    <div class="row">
        <h4 class="edit-new-posts">Ajouter un article</h4>
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

<?php
    $body = ob_get_clean();
    require(ROOT . '/App/View/layout.php');
?>

