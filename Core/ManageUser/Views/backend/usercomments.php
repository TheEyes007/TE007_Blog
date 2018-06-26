<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <h4>Liste des commentaires
            <a class="btn btn-warning float-right" href="/myaccount">Retour</a>
        </h4>
        <hr/>
        <div class="center-align">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre du commentaire</th>
                    <th scope="col">Contenu du commentaire</th>
                    <th scope="col">Nom de l'article</th>
                    <th scope="col">Date de création</th>
                    <th scope="col">Date de mise à jour</th>
                    <th scope="col">Créateurs</th>
                    <th scope="col">Signalement</th>
                    <th colspan=2 scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $ligne): ?>
                    <tr>
                        <td><?php echo $ligne->id; ?></td>
                        <td><?php echo $ligne->title_comments; ?></td>
                        <td><?php echo substr($ligne->contains,0,100); ?></td>
                        <td><?php echo $ligne->title; ?></td>
                        <td><?php echo $ligne->date_create; ?></td>
                        <td><?php echo $ligne->date_update; ?></td>
                        <td><?php echo $ligne->name ?></td>
                        <td>
                            <?php
                            if($ligne->alert === '0')
                            {
                                echo '<p class="btn btn-success btn-circle"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></p>';
                            }
                            else
                            {
                                echo '<p class="btn btn-success btn-circle"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></p>';
                            }
                            ?>
                        </td>
                        <td><a class="btn btn-info btn-circle" href="<?= "comments/views/".$ligne->id; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                        <td><a class="btn btn-warning btn-circle" href="<?= "comments/edit/".$ligne->id; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                        <td><a class="btn btn-danger btn-circle" href="<?= "comments/delete/".$ligne->id; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $body = ob_get_clean(); require(ROOT . '/Core/ManageUser/Views/layout.php'); ?>