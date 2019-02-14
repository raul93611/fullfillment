<?php
session_start();
ConnectionFullFillment::open_connection();
$provider = RepositorioProviderFullFillment::obtener_provider_por_id(ConnectionFullFillment::get_connection(), $id_provider);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $provider->obtener_id_item());
$deleted_provider = RepositorioProviderFullFillment::delete_provider(ConnectionFullFillment::get_connection(), $id_provider);
$description_comment = 'A provider was deleted from the item:
<b>ELOGIC PROPOSAL</b>
<b>Brand:</b>
' . $item-> obtener_brand() . '
<b>Part number:</b>
' . $item-> obtener_part_number() . '
';
$comment = new CommentRfqFullFillment('', $item-> obtener_id_rfq(), $_SESSION['username'], $description_comment, '');
RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
$fullfillment_users = UserFullFillmentRepository::get_all_fullfillment_users(ConnectionFullFillment::get_connection());
ConnectionFullFillment::close_connection();
foreach ($fullfillment_users as $fullfillment_user) {
  $to = $fullfillment_user-> get_email();
  $subject = 'A provider was deleted in proposal: ' . $item-> obtener_id_rfq();
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
  $message = '
  <html>
  <body>
  <h5>Comment:</h5>
  <p>A provider was deleted from the item.<br>
  <b>ELOGIC PROPOSAL</b><br>
  <b>Brand:</b><br>
  ' . $item-> obtener_brand() . '<br>
  <b>Part number:</b><br>
  ' . $item-> obtener_part_number() . '<br>
  <a href="' . EDIT_QUOTE . $item-> obtener_id_rfq() . '">Review</a></p>
  </body>
  </html>
  ';
  mail($to, $subject, $message, $headers);
}
if($deleted_provider){
  Redirection::redirect(EDIT_QUOTE . $item-> obtener_id_rfq() . '#caja_items');
}
?>
