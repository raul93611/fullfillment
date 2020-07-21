<?php
session_start();
if(isset($_POST['guardar_comment'])){
  Conexion::abrir_conexion();
  Connection::open_connection();
  ConnectionFullFillment::open_connection();
  $quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
  $comment = new CommentRfqFullFillment('', $_POST['id_rfq'], $_SESSION['username'], htmlspecialchars($_POST['comment_rfq']), '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  switch ($_SESSION['level']) {
    case 2:
      $user_rfq = RepositorioUsuario::obtener_usuario_por_nombre_usuario(Conexion::obtener_conexion(), $_SESSION['username']);
      $comment = new Comment('', $_POST['id_rfq'], $user_rfq-> obtener_id(), htmlspecialchars($_POST['comment_rfq']), '');
      RepositorioComment::insertar_comment(Conexion::obtener_conexion(), $comment);
      break;
    default:
      break;
  }
  ConnectionFullFillment::close_connection();
  Connection::close_connection();
  Conexion::cerrar_conexion();
  switch ($_SESSION['level']) {
    case 3:
      Redirection::redirect(EDIT_ACCOUNTING_QUOTE . $_POST['id_rfq']);
      break;
    default:
      Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq']);
      break;
  }
}
?>
