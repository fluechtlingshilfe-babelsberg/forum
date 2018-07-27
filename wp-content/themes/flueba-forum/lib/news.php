<?php

register_post_type('news', array(
    'public' => true,
    'label' => 'Neuigkeiten',
    'menu_icon' => 'dashicons-flag',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    /* TODO! 'capabilities' => array(
        'edit_posts' => 'edit_news',
        'edit_post' => 'edit_news',
        'edit_others_posts' => 'edit_news',
        'publish_posts' => 'edit_news',
        'read_post' => 'edit_news', //maybe add this to all groups if necessarry
        'read_private_posts' => 'edit_news',
        'delete_post' => 'edit_news'
    )*/
));

