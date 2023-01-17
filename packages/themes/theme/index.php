<?php

/* File: index.php */

use Timber\Timber;

$context = Timber::get_context();
//$context['post'] = Timber::query_post();

$templates = [
    'pages/page.twig',
];

Timber::render($templates, $context);