<?php get_header() ?>

<?php while (have_posts()) {
    the_post(); ?>
    <div class="my-3" style="color: #fff; background-color: <?= the_category_color() ?>">
	<div class="container py-3">
	    <h2 class="mt-0 mb-3"><?php the_title(); ?></h2>
	    <div style="opacity: 0.7">
		<span class="mr-2"><span class="fa fa-user"></span> <?php the_author() ?></span>
		<span class="mr-2"><span class="fa fa-tag"></span> <?= get_the_category()[0]->name ?></span>
		<span><span class="fa fa-calendar"></span> vor <?= human_time_diff(get_the_time('U'), current_time('timestamp')) ?></span>
	    </div>
	</div>
    </div>

<?php } rewind_posts() ?>

<div class="container mt-3">

<div class="row">
    <div class="col-md-9">
    <?php while (have_posts()) {
	the_post();
	echo get_avatar(get_the_author_meta('ID'), AVATAR_SIZE, null, false, array('class' => 'float-xs-left mr-2 mb-1')) ?>
	<div class="mb-1">
	    <strong class="mr-1"><?php the_author() ?></strong>
	    <small class="text-muted">
		vor <?= human_time_diff(get_the_time('U'), current_time('timestamp')) ?>
	    </small>
	</div>
	<?php the_content(); ?>
	<br>
	<?php comments_template();
    } ?>
    </div>

    <div class="col-md-3">
	<?php get_sidebar() ?>
    </div>
</div>

</div>

<?php get_footer() ?>
