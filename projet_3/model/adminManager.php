<?php
namespace projetfour\model;

    require_once('Manager.php');
class AdminManager extends Manager
{
    public function reportComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT * FROM commentaires WHERE strikes > 0');
        return $comments;
    }
    public function addArticle($titre,$article,$resume)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO billets (titre,contenu,date_creation,resume) VALUES (:titre,:article,NOW(),:resume)');
        $req->execute(array(
            'titre' => $titre,
            'article' => $article,
            'resume' => $resume
        ));
    }
    public function deleteArticle($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM billets WHERE id=:id');
        $req->execute(array(
            'id' => $id
        ));
    }
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM commentaires WHERE id=:id');
        $req->execute(array(
            'id' => $id
        ));
    }
    public function upComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE commentaires SET valid=:valid WHERE id=:id');
        $req->execute(array(
            'valid' => 1,
            'id' => $id
        ));
    }
    public function resetStrikes($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE commentaires SET strikes=:strikes WHERE id=:id');
        $req->execute(array(
            'strikes' => 0,
            'id' => $id
        ));
    }
}