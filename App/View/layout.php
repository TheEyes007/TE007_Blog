<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="/css/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="/vendor/bootstrap-4.1.1/css/bootstrap.min.css">
    </head>
        
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="/">Présentation<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/articles">Articles</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/contacts">Contactez-moi</a>
              </li>              
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </nav>        
        <?= $body ?>
        <script src="/public/vendor/bootstrap-4.1.1/js/bootstrap.min.js"></script>
        <script src="/public/js/main.js"></script>
        <!--<script src="../public/vendor/tinymce_4.7.12/tinymce/js/tinymce/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>-->  
    </body>
</html>
