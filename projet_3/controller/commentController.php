<?php
    namespace projetfour\controller;
    class CommentController extends Controller
    {
        public function formSubscribe()
        {
            require('view/frontend/formSubscribeView.php');
        }
        public function addComment($id, $pseudo, $message)
        {
            $commentManager = new \projetfour\model\CommentManager();
            $affectedLines = $commentManager->postComment($id, $pseudo, $message);
            if ($affectedLines === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            } else {
                header('Location: index.php?action=postView&id=' . $id);
            }
        }

        public function addStrike($id,$id_billet)
        {
            $commentManager = new \projetfour\model\CommentManager();
            $strikes = $commentManager->strikes($id);
            $strikes++;
            $commentManager->addStrikes($id, $strikes);
            header('Location:index.php?action=postView&id=' . $id_billet);
        }
    }