<?php

$title = 'Mon compte - Modifier mon commentaire';

ob_start();
?>
<div class="container">
    <div class="row inline-block">
        <h4 class="edit-new-posts">Editer un commentaire</h4>
        <hr/>
        <div class="form-group center-align">
            <form method="POST" action="" >
                <?php
                foreach ($comments_form as $value){
                    echo $value;
                }
                ?>
                <a class="btn btn-warning float-left" href="/myaccount/comments">Retour</a>
            </form>
        </div>
    </div>
</div>

<?php
$body = ob_get_clean();
require(ROOT . '/App/View/layout.php');
?>

