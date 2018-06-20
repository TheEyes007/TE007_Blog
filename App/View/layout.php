<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link href="/css/style.css" rel="stylesheet" />
    </head>
        
    <body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Accueil</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        if(!empty($_SESSION)) {
                            if (session_status() !== 2) {
                                echo "<li><a href=\"/register\">S'inscrire</a></li>";
                                echo "<li><a href=\"/login\">Se connecter</a></li>";
                            } else {
                                if($_SESSION['ROLE'] === '1') {
                                    echo "<li><a href=\"/myaccount\">Mon compte</a></li>";
                                    echo "<li><a href=\"/backoffice\">Gestion des articles</a></li>";
                                    echo "<li><a href=\"/backoffice/comments\">Gestion des commentaires</a></li>";
                                    echo "<li><a href=\"/logout\">Se déconnecter</a></li>";
                                }else{
                                    echo "<li><a href=\"/myaccount\">Mon compte</a></li>";
                                    echo "<li><a href=\"/logout\">Se déconnecter</a></li>";
                                }
                            }
                        }else{
                                echo "<li><a href=\"/register\">S'inscrire</a></li>";
                                echo "<li><a href=\"/login\">Se connecter</a></li>";
                            }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
        <?= $body ?>
        <script src="/vendor/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'#articles' });</script>
    </body>
</html>
