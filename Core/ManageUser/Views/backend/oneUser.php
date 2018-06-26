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
            <?php
                 if(!empty($_SESSION)) {
                     if ($_SESSION['ROLE'] != '1') {
                         echo '<a class="btn btn-danger float-right" style="margin-left:3px;" href="/myaccount/delete">Supprimer votre compte</a>';
                    }
                 }
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $value->date_create);
            ?>
                    <a class="btn btn-success float-right" style="margin-left:3px;" href="/myaccount/edit">Editer votre compte</a>
                    <a class="btn btn-success float-right" style="margin-left:3px;" href="/myaccount/comments">Lister vos commentaires</a>
                    <a class="btn btn-warning float-right" href="/">Retour</a>
            </h4>
            <hr/>
                <p>Nom en minuscule :  <?= $value->name_canonical ?></p>
                <p>Email :  <?= $value->email ?></p>
                <p>Date de création du compte :  <?= date_format($date,'d/m/Y H:i:s') ?></p>
            <?php endforeach; ?>
        </div>
    </div>
<?php $body = ob_get_clean(); require(ROOT . '/Core/ManageUser/Views/layout.php'); ?>