<?php $title = 'Connexion'; ?>
<?php ob_start();?>
<form method=post action="index.php?action=admin&resultat=sendNewArticle">
    <h3> Titre </h3>
    <textarea class=formArticle name=updateTitle><?php echo $post['titre']; ?></textarea>
    <br/>
    <h3> Resume  </h3>
    <textarea class=formArticle name=updateResume><?php echo $post['resume']; ?></textarea>
    <br/>
    <h3> Texte  </h3>
    <textarea class=formArticle name=updateArticle><?php echo $post['titre']; ?></textarea>
    <input type="submit" class="btn btn-success"/>
</form> 
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>