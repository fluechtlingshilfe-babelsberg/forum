<?php get_header() ?>

<div class="row">
    <div class="col-md-9">
    <?php while (have_posts()) {
	the_post();
	echo get_avatar(get_the_author_meta('ID'), AVATAR_SIZE, null, false, array('class' => 'float-xs-left mr-2 mb-1')) ?>
	    <div class="mb-2">
		<h4 class="mt-0 mr-1 d-inline"><?php the_title(); ?></h4>
		<strong><?php the_author() ?></strong>
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

<?php get_footer() ?>
