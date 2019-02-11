<?php
session_start();
if(isset($_POST['guardar_provider'])){
  ConnectionFullFillment::open_connection();
  $provider = new Provider('', $_POST['id_item'], $_POST['provider'], $_POST['price']);
  $id_provider = RepositorioProviderFullFillment::insertar_provider(ConnectionFullFillment::get_connection(), $provider);
  $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $provider-> obtener_id_item());
  $id_rfq = $item-> obtener_id_rfq();
  $description_comment = 'A new provider was created for the Item:
    <b>ELOGIC PROPOSAL</b>
    <b>Brand:</b>
    ' . $item-> obtener_brand() . '
    <b>Part number:</b>
    ' . $item-> obtener_part_number() . '
    <a href="' . EDIT_PROVIDER . $id_provider . '">Review</a>';
  $comment = new CommentRfqFullFillment('', $id_rfq, $_SESSION['username'], $description_comment, '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  $fullfillment_users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
  ConnectionFullFillment::close_connection();
  foreach ($fullfillment_users as $fullfillment_user) {
    $to = $fullfillment_user-> get_email();
    $subject = 'New provider in proposal: ' . $_POST['id_rfq'];
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
    $message = '
    <html>
    <body>
    <h5>Comment:</h5>
    <p>A new provider was created for the Item:
      <br>
      <b>ELOGIC PROPOSAL</b><br>
      <b>Brand:</b><br>
      ' . $item-> obtener_brand() . '<br>
      <b>Part number:</b><br>
      ' . $item-> obtener_part_number() . '<br>
      <a href="' . EDIT_PROVIDER . $id_provider . '">Review</a></p>
    </body>
    </html>
    ';
    mail($to, $subject, $message, $headers);
  }
  Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
}
?>
