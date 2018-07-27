<?php get_header() ?>

<div class="container mt-3">

<div class="row">
    <div class="col-md-9">
    <a class="nav-link" href="<?= get_permalink(get_page_by_path('news')) ?>">« Zurück</a>
    <br>
    <br>
    <?php while (have_posts()) {
    the_post(); ?>
	<div class="mb-1">
	    <h1><?php the_title() ?></h1>
	    <p class="text-muted">
	    <?= date_i18n("j. M", $date) ?>
	    </p>
	</div>
	<?php the_content(); ?>

	<?php the_news_meta() ?>
	<?php the_post_thumbnail('post-thumbnail', array('style' => 'width: auto; height: 100px', 'class' => 'float-xs-right img-rounded')) ?>
    <?php } ?>
    </div>

    <div class="col-md-3">
	<?php get_sidebar() ?>
    </div>
</div>

</div>

<?php get_footer() ?>
