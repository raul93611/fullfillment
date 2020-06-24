<?php
session_start();
if(isset($_POST['guardar_comment'])){
  Conexion::abrir_conexion();
  Connection::open_connection();
  ConnectionFullFillment::open_connection();
  $quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
  if($quote-> obtener_rfp()){
    $project = ProjectRepository::get_project_by_id(Connection::get_connection(), $quote-> obtener_rfp());
    $fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id_project(ConnectionFullFillment::get_connection(), $project-> get_id());
    $comment = new ProjectComment('', $fulfillment_project-> get_id(), $_SESSION['username'], htmlspecialchars($_POST['comment_rfq']), '');
    ProjectCommentRepository::insert_comment(ConnectionFullFillment::get_connection(), $comment);
    $fullfillment_users = UserFullFillmentRepository::get_all_project_management_users(ConnectionFullFillment::get_connection());
    /*
    foreach ($fullfillment_users as $fullfillment_user) {
      $to = $fullfillment_user-> get_email();
      $subject = 'New comment: project ' . $project-> get_id();
      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8\r\n";
      $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
      $message = '
      <html>
      <body>
      <h5>Quote:</h5>
      <p><a href="http://www.elogicportal.com/fullfillment/profile/edit_project/' . $project-> get_id() . '">' . $project-> get_id() . '</a></p>
      <h5>Comment:</h5>
      <p>' . nl2br($_POST['comment_rfq']) . '</p>
      </body>
      </html>
      ';
      mail($to, $subject, $message, $headers);
    }
    */
  }
  $comment = new CommentRfqFullFillment('', $_POST['id_rfq'], $_SESSION['username'], htmlspecialchars($_POST['comment_rfq']), '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  $fullfillment_users = UserFullFillmentRepository::get_all_fullfillment_users(ConnectionFullFillment::get_connection());
  /*
  foreach ($fullfillment_users as $fullfillment_user) {
    $to = $fullfillment_user-> get_email();
    $subject = 'New comment: proposal ' . $_POST['id_rfq'];
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
    $message = '
    <html>
    <body>
    <h5>Quote:</h5>
    <p><a href="http://www.elogicportal.com/fullfillment/profile/edit_quote/' . $_POST['id_rfq'] . '">' . $_POST['id_rfq'] . '</a></p>
    <h5>Comment:</h5>
    <p>' . nl2br($_POST['comment_rfq']) . '</p>
    </body>
    </html>
    ';
    mail($to, $subject, $message, $headers);
  }
  */
  switch ($_SESSION['level']) {
    case 2:
      $user_rfq = RepositorioUsuario::obtener_usuario_por_nombre_usuario(Conexion::obtener_conexion(), $_SESSION['username']);
      $comment = new Comment('', $_POST['id_rfq'], $user_rfq-> obtener_id(), htmlspecialchars($_POST['comment_rfq']), '');
      RepositorioComment::insertar_comment(Conexion::obtener_conexion(), $comment);
      $rfq_users = RepositorioUsuario::get_all_users_level_3(Conexion::obtener_conexion());
      /*
      foreach ($rfq_users as $rfq_user) {
        $to = $rfq_user-> obtener_email();
        $subject = 'New comment: proposal ' . $_POST['id_rfq'];
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
        $message = '
        <html>
        <body>
        <h5>Quote:</h5>
        <p><a href="http://www.elogicportal.com/rfq/perfil/cotizaciones/editar_cotizacion/' . $_POST['id_rfq'] . '">' . $_POST['id_rfq'] . '</a></p>
        <h5>Comment:</h5>
        <p>' . nl2br($_POST['comment_rfq']) . '</p>
        </body>
        </html>
        ';
        mail($to, $subject, $message, $headers);
      }
      */
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
