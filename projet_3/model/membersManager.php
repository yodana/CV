<?php
    namespace projetfour\model;
    require_once('Manager.php');

    class MembersManager extends Manager
    {
        public function pseudo()
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT pseudo FROM membres');
            return $req;
        }
        public function email()
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT email FROM membres');
            return $req;
        }
        public function addMember($pseudo,$password,$email)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO membres (pseudo,pass,email,date_inscription,id_groupe) VALUES (:pseudo,:pass,:email,NOW(),:id_groupe)');
            $req->execute(array(
                'pseudo' => $pseudo,
                'pass' =>  password_hash($password, PASSWORD_DEFAULT),
                'id_groupe' => 1,
                'email' => $email
            ));
        }
        public function password($pseudo)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT pass FROM membres WHERE pseudo=:pseudo');
            $req->execute(array(
                'pseudo' => $pseudo,
            ));
            $data = $req->fetch();
            return $data;
        }
        public function id($pseudo)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id FROM membres WHERE pseudo=:pseudo');
            $req->execute(array(
                'pseudo' => $pseudo,
            ));
            $data = $req->fetch();
            return $data['id'];
        }
        public function id_groupe($pseudo)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id_groupe FROM membres WHERE pseudo=:pseudo');
            $req->execute(array(
                'pseudo' => $pseudo,
            ));
            $data = $req->fetch();
            return $data['id_groupe'];
        }
    }