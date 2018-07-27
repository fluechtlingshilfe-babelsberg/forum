<?php

/**
 * Return the list of categories used for our posts
 */
function get_the_categories() {
    return array_values(array_filter(get_terms(array(
	'taxonomy' => 'category',
	'hide_empty' => false
    )), function($e) {
	return $e->slug != 'uncategorized';
    }));
}

function color_array() {
    return array(
	'#F44336',
	'#E91E63',
	'#9C27B0',
	'#673AB7',
	'#3F51B5',
	'#2196F3',
	'#039BE5',
	'#0097A7',
	'#009688',
	'#43A047',
	'#689F38',
	'#827717',
	'#EF6C00',
	'#FF5722',
	'#795548',
	'#607D8B'
    );
}

function lighter_color_array() {
    return array(
	'#EF5350',
	'#EC407A',
	'#AB47BC',
	'#7E57C2',
	'#5C6BC0',
	'#42A5F5',
	'#03A9F4',
	'#00ACC1',
	'#26A69A',
	'#4CAF50',
	'#7CB342',
	'#9E9D24',
	'#F57C00',
	'#FF7043',
	'#BCAAA4',
	'#78909C'
    );
}

function darker_color_array() {
    return array(
	'#E53935',
	'#D81B60',
	'#8E24AA',
	'#5E35B1',
	'#3949AB',
	'#1E88E5',
	'#0288D1',
	'#00838F',
	'#00897B',
	'#388E3C',
	'#558B2F',
	'#827717',
	'#E65100',
	'#F4511E',
	'#6D4C41',
	'#546E7A'
    );
}
function the_category_count($category) {
    echo sprintf(
	_n('1 Eintrag', '%s Einträge', $category->count),
	$category->count);
}

/**
 * Returns the best guess for an active category. On posts this is
 * the category of the open post, otherwise the open overview category, if any
 */
function active_category_slug() {
    if (is_single()) {
	the_post();
	$category = get_the_category()[0];
	rewind_posts();
	return $category->slug;
    }

    if (isset($_GET["category"]))
	return $_GET["category"];

    return null;
}

function active_category_index() {
    $categories = get_the_categories();
    $active = active_category_slug();

    for ($i = 0; $i < count($categories); $i++) {
	if ($categories[$i]->slug == $active)
	    return $i;
    }

    return -1;
}

/**
 * Returns the color for a category slug. Uses the post's category if null
 */
function the_category_color($category = null) {
    if (empty($category))
	$category = get_the_category()[0]->slug;

    $categories = get_the_categories();

    for ($i = 0; $i < count($categories); $i++) {
	if ($categories[$i]->slug == $category)
	    return darker_color_array()[$i * 2];
    }

    return '#333';
}

/**
 * Outputs the large full-width category selector.
 */
function the_colored_categories() {
    $categories = get_the_categories();
    if (count($categories) < 1) {
	echo "Es wurden noch keine Kategorien angelegt!";
	return;
    }
    $colors = color_array();
    $lighter_colors = lighter_color_array();
    $darker_colors = darker_color_array();
    $i = 0;
    $active = active_category_index();
    $background = $active >= 0 ? darker_color_array()[$active * 2] : '#333';
    $width = 100 / count($categories) . '%' ?>
    <div class="mt-2 mb-3" style="background-color: <?= $background ?>; overflow: hidden">
    <div class="mt-1 container clearfix" style="box-shadow: 0 0 8px rgba(0, 0, 0, 0.3)">
    <div class="row">
    <?php foreach ($categories as $category) { ?>
	<a style="width: <?= $width ?>; float: left; color: #fff; display: block; overflow: hidden" href="<?= site_url("?category=$category->slug") ?>">
	    <h4 style="background-color: <?= $colors[$i] ?>; font-weight: 200; padding: 32px 24px <?= strlen($category->name) > 12 ? '14px' : '40px' // hack! if we wrap on two lines, decrease bottom padding. proper way would be to have a fixed size and let text flow freely ?> 24px" class="mb-0">
		<?= $category->name ?>
	    </h4>
	    <div style="background-color: <?= $lighter_colors[$i] ?>; padding: 8px 24px; box-shadow: 0 -2px 15px rgba(0, 0, 0, 0.2)">
		<small><?php the_category_count($category) ?></small>
	    </div>
	</a>
    <?php $i += 2;
    } ?>
    </div>
    </div>
    </div>
<?php }

function the_colored_category_list() {
    $colors = color_array();
    $i = 0;

    foreach (get_the_categories() as $category) { ?>
	<div class="category-list-item">
	    <span style="background-color: <?= $colors[$i] ?>" class="color-blob"></span>
	    <a href="<?= site_url("?category=$category->slug") ?>"><?= $category->name ?></a>
	</div>
    <?php $i += 2;
    }
}

function the_author_box() {
    echo '<small class="text-muted">';
    echo get_avatar(get_the_author_meta('ID'), 22);
    echo ' ';
    the_author();
    echo '</small>';
}

function the_card($classes = 'col-sm-6 col-md-4') { ?>
<div class="<?= $classes ?>">
    <a href="<?php the_permalink() ?>" class="card card-outline-primary">
	<div class="card-block">
	    <div class="tag tag-default float-xs-right"><?php comments_number('Keine Antworten', 'Eine Antwort', '% Antworten') ?></div>
	    <h6 class="card-title"><?php the_title() ?></h6>
	    <p class="card-text"><?php the_excerpt() ?></p>
	    <?php the_author_box() ?>
	</div>
    </a>
</div>
<?php }

function the_post_preview() { ?>
<div class="">
    <a href="<?php the_permalink() ?>" class="d-block mb-1">
	<div class="float-xs-right"><?php the_author_box() ?></div>
	<strong><?php the_title() ?></strong>
	<div class="ml-1 tag tag-default"><?php comments_number('Keine Antworten', 'Eine Antwort', '% Antworten') ?></div>
    </a>
    <hr>
</div>
<?php }

