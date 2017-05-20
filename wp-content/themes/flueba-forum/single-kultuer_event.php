<?php get_header() ?>

<?php the_post() ?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= get_permalink(get_page_by_path('kultuer-veranstaltungen')) ?>">Veranstaltungen</a></li>
  <li class="breadcrumb-item active"><?php the_title() ?></li>
</ol>

<div class="post-about clearfix mb-1">
  <?php the_post_thumbnail('post-thumbnail', array('style' => 'width: auto; height: 300px', 'class' => 'float-sm-right')) ?>

  <h2><?php the_title() ?></h2>
  <p class="text-muted">
    <span class="fa fa-fw fa-map-marker"></span>
    <?php the_field('place') ?>
    <br>
    <span class="fa fa-fw fa-clock-o"></span>
    <?= date_i18n(get_option('date_format'), strtotime(get_field('date'))) ?>
    <?php the_field('time') ?> Uhr
    <br>
    <span class="fa fa-fw fa-ticket"></span>
    <?php if (!get_field('no_booking')) { ?>
      Noch <?php the_field('num_tickets') ?> Tickets verfügbar
      <?php } else { ?>
        Keine Anmeldung nötig
        <?php } ?>


      </p>
      <?php the_content() ?>
    </div>

    <div class="card card-block">
      <form class="form-inline" action="<?= admin_url("admin-post.php") ?>" method="post">
        <input type="hidden" name="action" value="request_tickets">
        <input type="hidden" name="event" value="<?= get_the_ID() ?>">
        <label class="sr-only" for="numberOfTickets">Name</label>
        <input type="number" value="2" class="form-control mr-sm-2 mb-sm-0" name="number_of_tickets" id="numberOfTickets" placeholder="Anzahl" style="width: 4rem;">
        Karten anfragen
        <button type="submit" value="Submit" class="btn btn-primary">Anfragen</button>
      </form>
    </div>

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
