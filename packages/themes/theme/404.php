<?php


/* File: page.php */

use Timber\Timber;

$context = Timber::get_context();

$templates             = [
    'pages/pageNotFound.twig',
];

Timber::render( $templates, $context );