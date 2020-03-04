<?php
    namespace projetfour\controller;
    class MembersController extends Controller
    {
        public function formSubscribe()
        {
            require('view/frontend/formSubscribeView.php');
        }
        public function verifSubscribe($pseudo,$password,$password2,$email)
        {
            if($this->securePseudo($pseudo) !== true)
            {
                $verif = $this->securePseudo($pseudo);
                header('Location:index.php?action=subscribe&error=' . $verif);
            }
            else if($this->securePassword($password,$password2) !== true)
            {
                $verif = $this->securePassword($password,$password2);
                header('Location:index.php?action=subscribe&error=' . $verif);
            }
            else if($this->secureEmail($email) !== true)
            {
                $verif = $this->secureEmail($email);
                header('Location:index.php?action=subscribe&error=' . $verif);
            }
                $this->addMember($pseudo,$password,$email);
        }
        public function addMember($pseudo,$password,$email)
        {
            $memberManager = new \projetfour\model\MembersManager();
            $memberManager->addMember($pseudo,$password,$email);
            header('Location:index.php');
        }
        public function formConnect()
        {
            require('view/frontend/formConnectView.php');
        }
        public function verifConnect($pseudo,$password)
        {
            $memberManager = new \projetfour\model\MembersManager();
            $pseudos = $memberManager->pseudo();
            $verif = NULL;
            while($data = $pseudos->fetch())
            {
                if($data['pseudo'] === $pseudo)
                {
                    $verif = "checkPseudo";
                }
            }
            if($verif === "checkPseudo")
            {
                $data = $memberManager->password($pseudo);
                if(password_verify($password,$data['pass']))
                    $this->connect($pseudo);
                else
                    header('Location:index.php?action=connection&error=false');
            }
            else
                header('Location:index.php?action=connection&error=false');
        }
        public function connect($pseudo)
        {
            $memberManager = new \projetfour\model\MembersManager();
            $_SESSION['id'] = $memberManager->id($pseudo);
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['id_groupe'] = $memberManager->id_groupe($pseudo);
            header('Location:index.php');
        }
        public function logOut()
        {
            session_destroy();
            header('Location:index.php');
        }
    }