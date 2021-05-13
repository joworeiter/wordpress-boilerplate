<?php

/* File: single.php */

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = new \Timber\Post();
$context['relatedPosts'] = [];

foreach($context['post']->categories() as $cat){
    $context['relatedPosts'] = array_merge($context['relatedPosts'], Timber::get_posts('cat=' . $cat->id));
}

Timber::render( 'pages/single.twig', $context );