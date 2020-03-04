
 <?php $title = htmlspecialchars($post['titre']) ?>
<?php ob_start();?>
<?php 
    if(isset($_SESSION['pseudo']))
    {?>
        <a href = "index.php" class="back">
            Retour à la liste des billets
        </a>
        <?php
         echo '<div class ="news">';
         echo
                         '<div class="titre">'
                             . $post['titre'] .
                         '</div>
                         <p>'
                             . $post['contenu'] . '<br/>';
                echo '</p></div>';
            ?>
        <h1>
            Commentaires
        </h1>
        <?php
            while ($data = $comment->fetch()) {
                echo '<div class ="row"><div class="col-lg-3"><p class="titreComment"><strong>' . htmlspecialchars($data['auteur']) . '</strong> le ' . $data['date_day_post'] . '</p> 
                <p class="comment"> ' . nl2br(htmlspecialchars($data['commentaire']));
                if(!($data['valid']))
                    echo '<a href="index.php?action=postView&id_comment=' . $data['id'] . '&id=' . $_GET['id'] . '&alert=report"> Signalez </a>';
                echo '</p></div></div>';
            }
        ?>
        <form method="post" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>">
            Votre commentaire: <br/>
            <textarea rows="5" cols="64" name="message"></textarea><br/>
            <input type="hidden" name="id_post" value= <?php echo $_GET['id'] ?> />
            <input type="hidden" name="pseudo" value=<?php echo $_SESSION['pseudo'] ?> />
            <input class="send" type="submit" value="Envoyez"/>
        </form>
        <?php $comment->closeCursor(); ?>
        <?php }
        else
            echo '<h4 class="col-lg-offset-5"> Veuillez vous inscrire ou vous connecter pour voir l\'article </h4>'; 
        ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
