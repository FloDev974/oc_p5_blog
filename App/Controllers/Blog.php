<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Post;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Blog extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function showAction()
    {
        $id = (int) $this->route_params['id'];
        $post = Post::getPostById($id);
        View::renderTemplate('Blog/postView.html.twig', [
            'post' => $post
        ]);
    }
}
