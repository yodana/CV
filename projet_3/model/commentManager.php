<?php
namespace projetfour\model;

require_once('Manager.php');
     class CommentManager extends Manager
     {
        public function getComments($id)
        {
            $db = $this->dbConnect();
            $comment = $db->prepare('SELECT id,auteur,commentaire,valid, DATE_FORMAT(date_commentaire,\'%d/%m/%Y à %Hh%imin%ss\') AS date_day_post FROM commentaires WHERE id_billet=:id_post ORDER BY date_commentaire DESC LIMIT 0,5');  
            $comment->execute(array(
                     'id_post' => $id
            ));
            return $comment;
        }
        public function postComment($id,$auteur,$message)
        {
            $db = $this->dbConnect();
            $comment = $db->prepare('INSERT INTO commentaires (auteur,commentaire,date_commentaire,id_billet,strikes,valid) VALUES(:auteur,:commentaire,NOW(),:id_post,:strikes,:valid)');
            $affectedLines = $comment->execute(array(
                'auteur' => htmlspecialchars($auteur),
                'commentaire' => htmlspecialchars($message),
                'id_post' => $id,
                'strikes' => 0,
                'valid' => 0
            ));
            return $affectedLines;
        }
        public function comment($id)
        {
            $db = $this->dbConnect();
            $comment = $db->prepare('SELECT * FROM commentaires WHERE id=:id');
            $comment->execute(array(
                'id' => $id
            ));
            return $comment;
        }
        public function strikes($id)
        {
            $db = $this->dbConnect();
            $comment = $db->prepare('SELECT strikes FROM commentaires WHERE id=:id');
            $comment->execute(array(
                'id' => $id
            ));
            $data = $comment->fetch();
            return $data['strikes'];
        }
        public function modifComment($id,$newMessage)
        {
            $db =$this->dbConnect();
            $comment = $db->prepare('UPDATE commentaires SET commentaire=:newMessage WHERE id=:id');
            $comment->execute(array(
                'newMessage' => $newMessage,
                'id' => $id
            ));
        }
        public function addStrikes($id,$strikes)
        {
            $db = $this->dbConnect();
            $comment = $db->prepare('UPDATE commentaires SET strikes=:strikes WHERE id=:id');
            $comment->execute(array(
                'id' => $id,
                'strikes' => $strikes
            ));
        }
     }