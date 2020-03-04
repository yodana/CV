<?php
    session_start();
    require_once('controller/Controller.php');
    require('controller/postController.php');
    require('controller/commentController.php');
    require('controller/membersController.php');
    require('controller/adminController.php');
    require_once('model/adminManager.php');
    require_once('model/postManager.php');
    require_once('model/commentManager.php');
    require_once('model/membersManager.php');
    try{
        if(isset($_GET['action']))
        {
            if(isset($_GET['id']) AND $_GET['action'] == "postView")
            {
                if($_GET['id'] > 0)
                {
                    if(isset($_GET['alert']))
                    {
                        if($_GET['alert'] === "report")
                        {
                            $controller = new \projetfour\controller\CommentController();
                            $controller->addStrike($_GET['id_comment'],$_GET['id']);
                        }
                    }
                        $controller = new projetfour\controller\Controller();
                        $controller->post();
                }
            }
            else if ($_GET['action'] == "addComment") 
            {
                $controller = new projetfour\controller\CommentController();
                $controller->addComment($_POST['id_post'], $_POST['pseudo'], $_POST['message']);
            }
            else if($_GET['action'] === "subscribe" AND !isset($_SESSION['id']))
            {
                $controller = new projetfour\controller\MembersController();
                if(!isset($_GET['resultat']))
                {
                    $controller->formSubscribe();
                }
                else 
                {
                    $controller->verifSubscribe($_POST['pseudo'],$_POST['password'],$_POST['password2'],$_POST['email']);
                }
            }
            else if($_GET['action'] === "connection" AND !isset($_SESSION['id']))
            {
                $controller = new projetfour\controller\MembersController();
                if(!isset($_GET['resultat']))
                {
                    $controller->formConnect();
                }
                else if($_GET['resultat'] === "ok")
                {
                    $controller->verifConnect(htmlspecialchars($_POST['pseudo']),htmlspecialchars($_POST['password']));
                }
            }
            else if($_GET['action'] === "logOut")
            {
                $controller = new projetfour\controller\MembersController();
                $controller->logOut();
            }
            else if($_GET['action'] === "admin" AND $_SESSION['id_groupe'])
            {
                if(!isset($_GET['resultat']))
                {
                    $controller = new projetfour\controller\AdminController();
                    $controller->backend();
                }
                else if($_GET['resultat'] === "update")
                {
                    if(isset($_GET['id']))
                    {
                        $controller = new \projetfour\controller\AdminController();
                        $controller->update($_GET['id']);
                    }
                    else{
                        $controller = new \projetfour\controller\PostController();
                        $controller->listPost();
                    }
                }
                else if($_GET['resultat'] === "create")
                {
                    $controller = new \projetfour\controller\AdminController();
                    $controller->create();
                }
                else if($_GET['resultat'] === "delete")
                {
                    if(isset($_GET['id']))
                    {
                        $controller = new \projetfour\controller\AdminController();
                        $controller->delete($_GET['id']);
                    }
                    $controller = new \projetfour\controller\PostController();
                    $controller->listPost();
                }
                else if($_GET['resultat'] === "sendNewArticle")
                {
                    $controller = new \projetfour\controller\AdminController();
                    $controller->newArticle(stripslashes($_POST['title']),stripslashes($_POST['article']),stripslashes($_POST['resume']));
                }
               else if ($_GET['resultat'] === "deleteComment" AND isset($_GET['id']))
                {
                    $controller = new \projetfour\controller\AdminController();
                    $controller->deleteComment($_GET['id']);
                }
                else if ($_GET['resultat'] === "validComment" AND isset($_GET['id']))
                {
                    $controller = new \projetfour\controller\AdminController();
                    $controller->validComment($_GET['id']);
                }
                else
                {
                    $controller = new \projetfour\controller\AdminController();
                    $controller->backend();
                }
            }
        }
        else
        {
            $controller = new projetfour\controller\PostController();
            $controller->listPost();
        }
    }
    catch (Exception $e){
        echo 'Erreur :' . $e->getMessage();
    }
?>