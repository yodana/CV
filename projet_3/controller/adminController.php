<?php
namespace projetfour\controller;
    class AdminController extends Controller
    {
        public function backend()
        {
            $adminManager = new \projetfour\model\AdminManager();
            $reportComments = $adminManager->reportComments();
            require('view/backend/backendView.php');
        }
        public function create()
        {
            require('view/backend/formNewArticleView.php');
        }
        public function update($id)
        {
            $postManager = new \projetfour\model\PostManager();
            $post = $postManager->getPost($id);
            require('view/backend/formUpdateArticleView.php');
        }
        public function newArticle($newTitle,$newArticle,$newResume)
        {
            $adminManager = new \projetfour\model\AdminManager();
            $adminManager->addArticle($newTitle,$newArticle,$newResume);
            header('Location:index.php?action=admin&resultat=okArticle');
        }
        public function delete($id)
        {
            $adminManager = new \projetfour\model\AdminManager();
            $adminManager->deleteArticle($id);
            header('Location:index.php?action=admin&resultat=delete');
        }
        public function deleteComment($id)
        {
            $adminManager = new \projetfour\model\AdminManager();
            $adminManager->deleteComment($id);
            header('Location:index.php?action=admin');
        }
        public function validComment($id)
        {
            $adminManager = new \projetfour\model\AdminManager();
            $adminManager->upComment($id);
            $adminManager->resetStrikes($id);
            header('Location:index.php?action=admin');
        }
    }