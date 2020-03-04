<?php
    namespace projetfour\controller;
    class Controller
    {
        public function post()
        {
            $postManager = new \projetfour\model\PostManager();
            $postComment = new \projetfour\model\CommentManager();
            $post = $postManager->getPost($_GET['id']);
            $comment = $postComment->getComments($_GET['id']);
            require('view/frontend/postView.php');
        }
        public function securePseudo($pseudo)
        {
            if(empty($pseudo))
                return 'empty';
            $memberManager = new \projetfour\model\MembersManager();
            $pseudos = $memberManager->pseudo();
            while($data = $pseudos->fetch())
            {
                if($data['pseudo'] == $pseudo)
                    return 'samePseudo';
            }
            return true;
        }
        public function securePassword($password,$password2)
        {
            if(empty($password))
                return 'empty';
            else if($password !== $password2)
            {
                return 'notSamePassword';
            }
            return true;
        }
        public function secureEmail($email)
        {
            if(empty($email))
                return 'empty';
            else if (!(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)))
                return 'wrongEmail';
            $memberManager = new \projetfour\model\MembersManager();
            $emails = $memberManager->email();
            while($data = $emails->fetch())
            {
                if($data['email'] === $email)
                    return 'sameEmail';
            }
            return true;
        }
    }
