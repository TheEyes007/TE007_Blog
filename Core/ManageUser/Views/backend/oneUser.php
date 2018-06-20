<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/06/2018
 * Time: 21:13
 */

$title = 'Mon blog';

ob_start();
?>
    <div class="container">
        <div class="row inline-block">
            <?php foreach($data as $value): ?>
            <h4 class="edit-new-posts">Compte personnel de <?= $value->name ?>
                    <a class="btn btn-success float-right" style="margin-left:3px;" href="/myaccount/edit">Editer votre compte</a>
                    <a class="btn btn-warning float-right" href="/">Retour</a>
            </h4>
            <hr/>
                <p>Nom en minuscule :  <?= $value->name_canonical ?></p>
                <p>Email :  <?= $value->email ?></p>
            <?php endforeach; ?>
        </div>
    </div>
<?php $body = ob_get_clean(); require(ROOT . '/Core/ManageUser/Views/layout.php'); ?>