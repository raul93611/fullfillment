<?php
session_start();
if(isset($_POST['guardar_comment'])){
  ConnectionFullFillment::open_connection();
  $comment = new CommentRfqFullFillment('', $_POST['id_rfq'], $_SESSION['username'], $_POST['comment_rfq'], '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq']);
}
?>
