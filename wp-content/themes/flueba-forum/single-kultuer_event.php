<?php get_header() ?>

<?php the_post() ?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= get_permalink(get_page_by_path('kultuer-veranstaltungen')) ?>">Veranstaltungen</a></li>
    <li class="breadcrumb-item active"><?php the_title() ?></li>
</ol>

<?php the_post_thumbnail('post-thumbnail', array('style' => 'width: auto; height: 300px', 'class' => 'float-sm-right')) ?>

<h2><?php the_title() ?></h2>
<p class="text-muted">
    <span class="fa fa-fw fa-map-marker"></span>
    <?php the_field('place') ?>
    <br>
    <span class="fa fa-fw fa-clock-o"></span>
    <?= date_i18n(get_option('date_format'), strtotime(get_field('date'))) ?>
    <?php the_field('time') ?> Uhr
</p>
<?php the_content() ?>

<div class="btn-group-vertical">
<a class="btn btn-secondary text-xs-left" href="<?php the_field('link') ?>" class="card-link">
    <span class="fa fa-ticket fa-fw"></span>
    Zwei Karten buchen
</a>
<a class="btn btn-secondary text-xs-left" href="<?php the_field('link') ?>" class="card-link">
    <span class="fa fa-question fa-fw"></span>
    Mehr Karten anfragen
</a>
<a class="btn btn-secondary text-xs-left" href="<?php the_field('link') ?>" class="card-link">
    <span class="fa fa-info fa-fw"></span>
    Zur Seite des Veranstalters
</a>
</div>

<?php get_footer() ?>
