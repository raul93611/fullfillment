<?php
session_start();
ConnectionFullFillment::open_connection();
$provider_subitem = RepositorioProviderSubitemFullFillment::obtener_provider_subitem_por_id(ConnectionFullFillment::get_connection(), $id_provider_subitem);
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $provider_subitem->obtener_id_subitem());
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
RepositorioProviderSubitemFullFillment::delete_provider_subitem(ConnectionFullFillment::get_connection(), $id_provider_subitem);
$description_comment = 'A subitem\'s provider was deleted:
<b>ELOGIC PROPOSAL</b>
<b>Brand:</b>
' . $subitem-> obtener_brand() . '
<b>Part number:</b>
' . $subitem-> obtener_part_number() . '
';
$comment = new CommentRfqFullFillment('', $item-> obtener_id_rfq(), $_SESSION['username'], $description_comment, '');
RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
$fullfillment_users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
ConnectionFullFillment::close_connection();
foreach ($fullfillment_users as $fullfillment_user) {
  $to = $fullfillment_user-> get_email();
  $subject = 'A subitem\'s provider was deleted in proposal: ' . $item-> obtener_id_rfq();
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
  $message = '
  <html>
  <body>
  <h5>Comment:</h5>
  <p>A subitem\'s provider was deleted.<br>
  <b>ELOGIC PROPOSAL</b><br>
  <b>Brand:</b><br>
  ' . $subitem-> obtener_brand() . '<br>
  <b>Part number:</b><br>
  ' . $subitem-> obtener_part_number() . '<br>
  <a href="' . EDIT_QUOTE . $item-> obtener_id_rfq() . '">Review</a></p>
  </body>
  </html>
  ';
  mail($to, $subject, $message, $headers);
}
Redirection::redirect(EDIT_QUOTE . $item-> obtener_id_rfq() . '#caja_items');
?>
