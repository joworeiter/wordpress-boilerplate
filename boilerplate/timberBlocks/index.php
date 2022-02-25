<?php

use Timber\Timber;
use Timber\Post;
use Timber\Term;
use Timber\Image;


add_filter('allowed_block_types_all', 'custom_allowed_block_types');

function custom_allowed_block_types($allowed_blocks)
{

    return array(
        'core/paragraph',
        'core/heading',
        'core/image',
        'acf/headline',
        'acf/key-visual',
        'acf/step-component',
        'acf/contact-information-box',
        'acf/icon-chooser-3',
        'acf/main-news',
        'acf/downloads',
        'acf/news-teaser',
        'acf/staff',
        'acf/contact-form'
    );

}

add_filter('timber/acf-gutenberg-blocks-data/contact-information-box', function ($context) {

    $context['expert'] = new Post($context['fields']['staff']);

    return $context;
});

add_filter('timber/acf-gutenberg-blocks-data/staff', function ($context) {

    $context['fields']['department'] = new Term($context['fields']['department']);

    return $context;
});

add_filter('timber/context', 'add_to_context');
function add_to_context($context)
{
    // Now, in similar fashion, you add a Timber Menu and send it along to the context.
    $context['menu'] = new \Timber\Menu('Hauptmenü');
    return $context;
}

add_filter('timber/acf-gutenberg-blocks-data/downloads', function ($context) {

    $args = array(
        'numberposts' => -1,
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'order_by' => 'date',
        'order' => 'DESC'
    );

    $files = Timber::get_posts($args);

    $data = [];
    $terms = [];


    foreach ($files as $file) {

        if( isset($file->custom['category']  )){
            $id = $file->custom['category'];

            print_r($id);


            $data[$id] = [];
            $terms[$id] = new Term(20);

            print_r($terms);
            echo '<br>';
        }
    }

    foreach ($files as $file) {
        array_push($data[$file->custom['category']], $file);
    }

    $context['files'] = $data;
    $context['terms'] = $terms;

    return $context;
});


add_filter('timber/acf-gutenberg-blocks-data/main-news', function ($context) {

    $context['post'] = new Post($context['fields']['newsposting']);
    return $context;
});

add_filter('timber/acf-gutenberg-blocks-data/news-teaser', function ($context) {
    $categoryId = $context['fields']['categories'];

    $posts = array();

    foreach ($categoryId as $id) {
        $posts = array_merge($posts, Timber::get_posts('cat=' . $id));
    }

    if (count($posts) < 9) {
        array_splice($posts, 9);
    }

    $context['fields']['posts'] = $posts;

    return $context;
});

add_filter('timber/acf-gutenberg-blocks-data/step-component', function ($context) {

    $context['image'] = new Image($context['fields']['img']);

    return $context;
});