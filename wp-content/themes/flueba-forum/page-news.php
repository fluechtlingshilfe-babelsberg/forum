<?php get_header() ?>

<?php $posts = query_posts(array(
    'post_type' => 'news',
    'posts_per_page' => -1
)); ?>

<div class="container kultuer mt-3">
<h2>Neues in Potsdam</h2>

<hr>

<?php
while (have_posts()) {
    the_post();
    $date = strtotime(get_field('date')); ?>
    <div class="event clearfix">
	<div class="event-date float-xs-left mr-3">
	    <span class="event-date-number"><?= date_i18n("j", $date) ?></span>
	    <span class="event-date-word"><?= date_i18n("M", $date) ?></span>
	</div>
	<div class="event-details">
	    <?php the_post_thumbnail('post-thumbnail', array('style' => 'width: auto; height: 100px', 'class' => 'float-xs-right img-rounded')) ?>
	    <a class="clear-color" href="<?php the_permalink() ?>">
		<h4 class="event-title"><?php the_title() ?></h4>
	    </a>
	    <?php the_excerpt() ?>
	    <?php the_news_meta() ?>
	</div>
    </div>
    <hr>
<?php } ?>
</div>

<?php get_footer() ?>
