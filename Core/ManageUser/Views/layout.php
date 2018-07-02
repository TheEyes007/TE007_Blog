<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
    <link href="/css/style.css" rel="stylesheet" />
</head>

<body>
<nav class="navbar navbar-inverse">
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
                        echo "<li><a href=\"/contact\">Contact</a></li>";
                    } else {
                        if($_SESSION['ROLE'] === '1') {
                            echo "<li><a href=\"/myaccount\">Mon compte</a></li>";
                            echo "<li><a href=\"/backoffice\">Gestion des chapitres</a></li>";
                            echo "<li><a href=\"/backoffice/comments\">Gestion des commentaires</a></li>";
                            echo "<li><a href=\"/backoffice/users\">Gestion des utilisateurs</a></li>";
                            echo "<li><a href=\"/logout\">Se déconnecter</a></li>";
                        }else{
                            echo "<li><a href=\"/myaccount\">Mon compte</a></li>";
                            echo "<li><a href=\"/logout\">Se déconnecter</a></li>";
                            echo "<li><a href=\"/contact\">Contact</a></li>";
                        }
                    }
                }else{
                    echo "<li><a href=\"/register\">S'inscrire</a></li>";
                    echo "<li><a href=\"/login\">Se connecter</a></li>";
                    echo "<li><a href=\"/contact\">Contact</a></li>";
                }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="box">
    <?= $body ?>
</div>
<footer id="footer-Section">
    <div class="footer-top-layout">
        <div class="container">
            <div class="row">
                <div class="OurBlog">
                    <h4>Jean Forteroche vous présente son roman en ligne, Billet simple pour l'Alaska</h4>
                    <p>Suivez mon périple au fil de mes chapitres</p>
                    <div class="post-blog-date">Debut du livre le 26 juin 2018</div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-layout">
        <div class="copyright-tag">Copyright © 2018 Jean Forteroche. All Rights Reserved.</div>
    </div>
</footer>
<script src="/vendor/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'#articles' });</script>
</body>
</html>