<?php

class BootstrapNavWalker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = array()) {
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
	$classes = join(' ', $item->classes ? $item->classes : []);
	$output .= '<li class="nav-item">';
	$output .= '<a title="'.$item->attr_title.'" class="nav-link '.($item->current ? 'active' : '').'" href="'.$item->url.'">';
	$output .= apply_filters('the_title', $item->title, $item->ID);
    }

    public function end_el(&$output, $object, $depth = 0, $args = array()) {
	$output .= '</a></li>';
    }
}

// add settings item
add_filter('wp_nav_menu_items', function($items, $menu) {
    if ($menu->theme_location != 'primary')
	return $items;

    $items .= '<li class="nav-item">
	<a class="nav-link" href="'.admin_url('profile.php').'"><span class="fa fa-cog"></span></a>
	</li>';

    return $items;
}, 10, 2);
