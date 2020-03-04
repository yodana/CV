<?php
namespace projetfour\model;

require_once('Manager.php');
    class PostManager extends Manager
    {
        public function getPosts(){
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, titre, contenu, resume, DATE_FORMAT(date_creation,\'%d/%m/%Y à %Hh%imin%ss\') AS date_day FROM billets ORDER BY id DESC LIMIT 0,5');
            return $req;
        }
        public function getPost($id){
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, resume, titre, contenu, DATE_FORMAT(date_creation,\'%d/%m/%Y à %Hh%imin%ss\') AS date_day FROM billets WHERE id=:id_post');
            $req->execute(array(
                'id_post' => $id
            ));
            $post = $req->fetch();
            return $post;
        }
    }