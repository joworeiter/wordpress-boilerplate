<?php

/* File: page.php */

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = Timber::query_post();
$context['terms'] = Timber::get_terms('category');

$templates             = [
    'pages/blog.twig',
];

Timber::render( $templates, $context );