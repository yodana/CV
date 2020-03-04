<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$title?></title>
        <link href="public/assets/css/bootstrap.css" rel="stylesheet">
        <link href="public/css/style.css" rel="stylesheet" />
        <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
        <script>
            tinymce.init({
                selector: '.formArticle',
            });
        </script>
    </head>  
    <body>
        <head>
            <div class ="row">
                <div class="col-lg-3 col-lg-offset-4">
                    <h1> Billet simple pour l'Alaska </h1>
                </div>
            <?php
            if(!isset($_SESSION['id']))
            {
                echo '<div class="col-lg-1">
                <a href="index.php?action=subscribe"> <button>Inscription</button></a>
                </div> 
                <div class="col-lg-1">
                    <a href="index.php?action=connection"><button> Connexion </button></a>
                </div>';
            }
            else
            {
                echo '<div class="col-lg-1">
                <a href="index.php?action=logOut"> <button>Deconnexion</button></a>
                </div>';
               if ($_SESSION['id_groupe'])
                 echo '<a href=index.php?action=admin> Espace administateur </a>';
            }
            ?>
            </div>
        </head>
        <?= $content ?>
    </body>
</html>