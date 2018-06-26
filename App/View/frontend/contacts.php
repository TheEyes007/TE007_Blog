<?php

use App\Form\ContactForm;

$title = 'Mon blog';
$form = new ContactForm();
$contact_form = $form->NewContact();


ob_start();
?>
<div class="container">
    <div class="row">
        <div class="form-group center-align">
            <form method="POST" action="" >
                <?php
                foreach ($contact_form as $value){
                    echo $value;
                }
                ?>
                <a class="btn btn-warning float-left" href="/">Retour</a>
            </form>
        </div>
    </div>
</div>

<?php $body = ob_get_clean(); require(ROOT . '/App/View/layout.php'); ?>