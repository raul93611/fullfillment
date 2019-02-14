<?php
session_start();
if (isset($_POST['guardar_cambios_provider_subitem'])) {
  ConnectionFullFillment::open_connection();
  RepositorioProviderSubitemFullFillment::actualizar_provider_subitem(ConnectionFullFillment::get_connection(), $_POST['id_provider_subitem'], $_POST['provider'], $_POST['price']);
  $provider_subitem = RepositorioProviderSubitemFullFillment::obtener_provider_subitem_por_id(ConnectionFullFillment::get_connection(), $_POST['id_provider_subitem']);
  $subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $provider_subitem-> obtener_id_subitem());
  $cambios = [];
  if($_POST['provider'] != $_POST['provider_original']){
    $cambios[] = 'provider';
  }

  if($_POST['price'] != $_POST['price_original']){
    $cambios[] = 'price';
  }

  if(count($cambios)){
    $cambios = implode(',', $cambios);
    $description_comment = 'A subitem\'s provider was modified . The fields: <b>' . $cambios . '</b>
    <b>ELOGIC PROPOSAL</b>
    <b>Brand:</b>
    ' . $subitem-> obtener_brand() . '
    <b>Part number:</b>
    ' . $subitem-> obtener_part_number() . '
    <a href="' . EDIT_PROVIDER_SUBITEM . $_POST['id_provider_subitem'] . '">Review</a>';
    $comment = new CommentRfqFullFillment('', $_POST['id_rfq'], $_SESSION['username'], $description_comment, '');
    RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
    $fullfillment_users = UserFullFillmentRepository::get_all_fullfillment_users(ConnectionFullFillment::get_connection());
    foreach ($fullfillment_users as $fullfillment_user) {
      $to = $fullfillment_user-> get_email();
      $subject = 'A subitem\'s provider was modified in proposal: ' . $_POST['id_rfq'];
      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8\r\n";
      $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
      $message = '
      <html>
      <body>
      <h5>Comment:</h5>
      <p>A subitem\'s provider was modified. The fields: <b>' . $cambios . '</b><br>
      <b>ELOGIC PROPOSAL</b><br>
      <b>Brand:</b><br>
      ' . $subitem-> obtener_brand() . '<br>
      <b>Part number:</b><br>
      ' . $subitem-> obtener_part_number() . '<br>
      <a href="' . EDIT_PROVIDER_SUBITEM . $_POST['id_provider_subitem'] . '">Review</a></p>
      </body>
      </html>
      ';
      mail($to, $subject, $message, $headers);
    }
  }
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
}
?>
