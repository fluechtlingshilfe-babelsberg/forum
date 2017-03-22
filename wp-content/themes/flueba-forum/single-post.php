<?php get_header() ?>

<div class="row">
    <div class="col-md-9">
    <?php while (have_posts()) {
	the_post();
	echo get_avatar(get_the_author_meta('ID'), AVATAR_SIZE, null, false, array('class' => 'float-xs-left mr-1 mb-1')) ?>
	<h4><?php the_title(); ?></h4>
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
