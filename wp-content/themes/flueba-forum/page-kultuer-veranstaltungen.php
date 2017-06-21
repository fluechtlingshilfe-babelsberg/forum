<?php get_header() ?>

<?php $posts = query_posts(array(
    'post_type' => 'kultuer_event'
)); ?>

<div class="col-md-8 kultuer">

<?php
if(isset($_GET['message'])) {
  ?> <div class="alert alert-success" role="alert"><?=$_GET['message'] ?></div> <?php
}
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
	    <p class="text-muted">
		<?php the_field('place') ?> - <?php the_field('time') ?> Uhr
	    </p>
	    <?php if (!get_field('no_booking')) { ?>
		<a class="btn btn-primary btn-sm" href="<?php the_permalink() ?>" class="card-link">Noch <?php the_field('num_tickets') ?> Karten. Buchen »</a>
	    <?php } else { ?>
		<a class="btn btn-primary btn-sm" href="<?php the_permalink() ?>" class="card-link">Kostenlos. Mehr Details »</a>
	    <?php } ?>
	</div>
    </div>
    <hr>
<?php } ?>
</div>

<?php get_footer() ?>
