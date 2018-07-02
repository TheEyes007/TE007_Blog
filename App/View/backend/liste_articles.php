<?php $title = 'Backoffice - Liste des chapitres'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div clas="inline-block">
            <h4>Liste des chapitres
                <a class="btn btn-success float-right" style="margin-left:3px;" href="/backoffice/add">Nouveau chapitre</a>
                <a class="btn btn-warning float-right" href="/">Retour</a>
            </h4>
        </div>
        <hr/>
        <div class="center-align">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Contenu du chapitre</th>
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
                    <td>
                        <?php
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $ligne->date_create);
                        echo date_format($date,'d/m/Y H:i:s');
                        ?>
                    </td>
                    <td>
                        <?php
                        if($ligne->date_update !=NULL)
                        {
                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $ligne->date_update);
                            echo date_format($date,'d/m/Y H:i:s');
                        }
                        ?>
                    </td>
                    <td><?php echo $ligne->name; ?></td>
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

