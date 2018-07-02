<?php $title = 'Backoffice - Liste des utilisateurs'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div clas="inline-block">
            <h4>Liste des utilisateurs
                <a class="btn btn-warning float-right" href="/">Retour</a>
            </h4>
        </div>
        <hr/>
        <div class="center-align">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Compte actif</th>
                    <th scope="col">Date de création</th>
                    <th class="center-align" scope="col">Activer le compte</th>
                    <th class="center-align" scope="col">Supprimer le compte</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $ligne): ?>
                    <tr>
                        <td><?php echo $ligne->id; ?></td>
                        <td><?php echo $ligne->name; ?></td>
                        <td><?php echo $ligne->email; ?></td>
                        <?php
                        if($ligne->status === '1'){
                            echo '<td>Administrateur</td>';
                        }else{
                            echo '<td>Utilisateur</td>';
                        }
                        if($ligne->active === '1'){
                            echo '<td>Oui</td>';
                        }else{
                            echo '<td>Non</td>';
                        }
                        ?>
                        <td>
                            <?php
                                $date = DateTime::createFromFormat('Y-m-d H:i:s', $ligne->date_create);
                                echo date_format($date,'d/m/Y H:i:s');
                            ?>
                        </td>
                        <?php if($ligne->active === '1'): ?>
                            <td><p class="btn btn-success btn-circle"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></p></td>
                        <?php else: ?>
                            <td><a class="btn btn-warning btn-circle" href="<?= "users/activate/".$ligne->id; ?>"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                        <?php endif; ?>
                        <td><a class="btn btn-danger btn-circle" href="<?= "users/delete/".$ligne->id; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $body = ob_get_clean(); require(ROOT . '/Core/ManageUser/Views/layout.php'); ?>