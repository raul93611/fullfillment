<?php
session_start();
if(isset($_POST['guardar_comment'])){
  ConnectionFullFillment::open_connection();
  $comment = new CommentRfqFullFillment('', $_POST['id_rfq'], $_SESSION['username'], $_POST['comment_rfq'], '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  $users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
  ConnectionFullFillment::close_connection();
  foreach ($users as $user) {
    $to = $user-> get_email();
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
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq']);
}
?>
