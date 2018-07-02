<?php $title = 'Backoffice - Liste des commentaires'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <h4>Liste des commentaires
            <a class="btn btn-warning float-right" href="/backoffice">Retour</a>
        </h4>
        <hr/>
        <div class="center-align">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Contenu du commentaire</th>
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
                            if($ligne->date_update != NULL){
                                $date = DateTime::createFromFormat('Y-m-d H:i:s', $ligne->date_update);
                                echo date_format($date,'d/m/Y H:i:s');
                            }
                            ?>
                        </td>
                        <td><?php echo $ligne->name ?></td>
                        <td>
                            <?php
                                if($ligne->alert === '0')
                                {
                                    echo '<a class="btn btn-success btn-circle" href="comments/alert/'.$ligne->id.'"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></a>';
                                }
                                else
                                {
                                    echo '<a class="btn btn-danger btn-circle" href="comments/alert/'.$ligne->id.'"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></a>';
                                }
                             ?>
                        </td>
                        <td><a class="btn btn-info btn-circle" href="<?= "comments/views/".$ligne->id; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                        <td><a class="btn btn-danger btn-circle" href="<?= "comments/delete/".$ligne->id; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $body = ob_get_clean(); ?>

<?php require(ROOT . '/App/View/layout.php'); ?>

