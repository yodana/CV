<?php

namespace projetfour\controller;

class PostController extends Controller
{
    public function listPost()
    {
        $postManager = new \projetfour\model\PostManager();
        $posts = $postManager->getPosts();
        require('view/frontend/postsView.php');
    }
}