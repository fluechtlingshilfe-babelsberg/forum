<?php

register_post_type('kultuer_event', array(
    'public' => true,
    'label' => 'Veranstaltungen',
    'menu_icon' => 'dashicons-calendar-alt',
    'supports' => array('title', 'editor', 'thumbnail')
));

