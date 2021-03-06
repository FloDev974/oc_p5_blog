<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Post;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $posts = Post::getAllPost();

        View::renderTemplate('Home/index.html.twig', [
            'posts' => $posts
        ]);
    }
}
