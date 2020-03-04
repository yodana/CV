<?php $title = 'Connexion'; ?>
<?php ob_start();?>
<form method=post action="index.php?action=admin&resultat=sendNewArticle">
    <h3> Titre du nouveau article </h3>
    <textarea class=formArticle name=title></textarea>
    <br/>
    <h3> Resume du nouvel article </h3>
    <textarea class=formArticle name=resume></textarea>
    <br/>
    <h3> Texte du nouvel article </h3>
    <textarea class=formArticle name=article></textarea>
    <input type="submit" class="btn btn-success"/>
</form>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>