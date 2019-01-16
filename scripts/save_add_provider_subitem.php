<?php
session_start();
if(isset($_POST['guardar_provider_subitem'])){
  ConnectionFullFillment::open_connection();
  $provider_subitem = new ProviderSubitem('', $_POST['id_subitem'], $_POST['provider'], $_POST['price']);
  $id_provider_subitem = RepositorioProviderSubitemFullFillment::insertar_provider_subitem(ConnectionFullFillment::get_connection(), $provider_subitem);
  $subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $provider_subitem-> obtener_id_subitem());
  $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
  $id_rfq = $item-> obtener_id_rfq();
  $description_comment = 'A new provider was created for the subitem:
    <b>ELOGIC PROPOSAL</b>
    <b>Brand:</b>
    ' . $subitem-> obtener_brand() . '
    <b>Part number:</b>
    ' . $subitem-> obtener_part_number() . '
    <a href="' . EDIT_PROVIDER_SUBITEM . $id_provider_subitem . '">Review</a>';
  $comment = new CommentRfqFullFillment('', $id_rfq, $_SESSION['username'], $description_comment, '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  $fullfillment_users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
  ConnectionFullFillment::close_connection();
  foreach ($fullfillment_users as $fullfillment_user) {
    $to = $fullfillment_user-> get_email();
    $subject = 'New provider for a subitem in proposal: ' . $id_rfq;
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
    $message = '
    <html>
    <body>
    <h5>Comment:</h5>
    <p>A new provider was created for the subitem:
      <br>
      <b>ELOGIC PROPOSAL</b><br>
      <b>Brand:</b><br>
      ' . $subitem-> obtener_brand() . '<br>
      <b>Part number:</b><br>
      ' . $subitem-> obtener_part_number() . '<br>
      <a href="' . EDIT_PROVIDER_SUBITEM . $id_provider_subitem . '">Review</a></p>
    </body>
    </html>
    ';
    mail($to, $subject, $message, $headers);
  }
  Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
}
?>
