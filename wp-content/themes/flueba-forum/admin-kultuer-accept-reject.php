<?php
define('DEFAULT_ACCEPT_TEXT', "Lieber Nutzer,\n\nIhr Ticket wurde bestätigt!");
define('DEFAULT_REJECT_TEXT', "Lieber Nutzer,\n\nIhre Ticketanfrage wurde leider abgelehnt!");
?>
<h1>Ticketanfrage <?= $_GET['ticketAction'] == 'accept' ? 'annehmen' : 'ablehnen' ?></h1>
<hr>
<form action="confirm_tickets" method="post">
  <textarea rows="8" class="regular-text" id="responseText"><?= $_GET['ticketAction'] == 'accept' ? DEFAULT_ACCEPT_TEXT : DEFAULT_REJECT_TEXT ?></textarea>
  <br>
  <button class="button button-primary" value="submit">Antwort senden</button>
  <input type="hidden" id="event_id" value="<?= $_GET['eventId'] ?>"></input>
  <input type="hidden" id="num_tickets_requested" value="<?= $_GET['numTicketsRequested'] ?>"></input>
</form>
