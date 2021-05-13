<?php

add_filter('acf/load_field/name=icon_name', 'acf_load_icon_field_choices');

function acf_load_icon_field_choices($field)
{

    $field['choices'] = array();
    $iconDir = __DIR__ . '/../../views/icons';
    $icons = [];

    foreach (new DirectoryIterator($iconDir) as $file) {
        if ($file->isFile()) {
            $iconValue = $file->getBasename('.svg');
            $iconName = ucwords(str_replace('-', ' ', $iconValue));
            $icons[$iconValue] = $iconName;
        }
    }
    $field['choices'] = $icons;

    return $field;

}

