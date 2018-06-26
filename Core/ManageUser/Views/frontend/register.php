<?php

use Core\ManageUser\Form\ManageUserForm;

$title = 'Mon blog';
$form = new ManageUserForm();
$user_form = $form->NewUser();


ob_start();
?>
<div class="container">
    <div class="row">
        <h4 class="edit-new-posts">Inscrivez-vous</h4>
        <hr/>
        <div class="form-group center-align">
            <form method="POST" action="" >
                <?php
                foreach ($user_form as $value){
                    echo $value;
                }
                ?>
                <a class="btn btn-warning float-left" href="/">Retour</a>
            </form>
        </div>
    </div>
</div>

<?php $body = ob_get_clean(); require(ROOT . '/Core/ManageUser/Views/layout.php'); ?>