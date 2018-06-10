<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div clas="inline-block">
            <h4>Listes des articles
                <a class="btn btn-success float-right" href="/backoffice/add">Nouveau article</a>
            </h4>
        </div>
        <hr/>
        <div class="center-align">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Contenu de l'article</th>
                    <th scope="col">Date de création</th>
                    <th scope="col">Date de mise à jour</th>
                    <th scope="col">Créateurs</th>
                    <th class="center-align" colspan=2 scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $ligne): ?>
                <tr>
                    <td><?php echo $ligne->id; ?></td>
                    <td><?php echo $ligne->title; ?></td>
                    <td><?php echo substr($ligne->contains,0,100); ?></td>
                    <td><?php echo $ligne->date_create; ?></td>
                    <td><?php echo $ligne->date_update; ?></td>
                    <td><?php if($ligne->fk_user === '1')echo "Administrateur"; ?></td>
                    <td><a class="btn btn-info btn-circle" href="<?= "backoffice/views/".$ligne->id; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                    <td><a class="btn btn-warning btn-circle" href="<?= "backoffice/edit/".$ligne->id; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                    <td><a class="btn btn-danger btn-circle" href="<?= "backoffice/delete/".$ligne->id; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

<?php $body = ob_get_clean(); ?>

<?php require(ROOT . '/App/View/layout.php'); ?>

