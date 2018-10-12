<?php
session_start();
if(isset($_POST['guardar_comment'])){
  ConnectionFullFillment::open_connection();
  $comment = new Comment('', $_POST['id_rfq'], $_SESSION['id_user'], $_POST['comment_rfq'], '');
  RepositorioFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq']);
}
?>
