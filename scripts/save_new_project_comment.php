<?php
session_start();
header('Content-Type: application/json');
$comment = new ProjectComment('', $_POST['id_fulfillment_project'], $_SESSION['username'], htmlspecialchars($_POST['comment']), '');
ConnectionFullFillment::open_connection();
Connection::open_connection();
$fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id(ConnectionFullFillment::get_connection(), $_POST['id_fulfillment_project']);
$project = ProjectRepository::get_project_by_id(Connection::get_connection(), $fulfillment_project-> get_id_project());
ProjectCommentRepository::insert_comment(ConnectionFullFillment::get_connection(), $comment);
$fullfillment_users = UserFullFillmentRepository::get_all_fullfillment_users(ConnectionFullFillment::get_connection());
if($project-> get_type() == 'services_and_equipment'){
  $quote = RepositorioRfqFullFillment::get_quote_by_rfp(ConnectionFullFillment::get_connection(), $project-> get_id());
  $comment = new CommentRfqFullFillment('', $quote-> obtener_id(), $_SESSION['username'], htmlspecialchars($_POST['comment']), '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  $fullfillment_users = UserFullFillmentRepository::get_all_fullfillment_users(ConnectionFullFillment::get_connection());
  foreach ($fullfillment_users as $fullfillment_user) {
    $to = $fullfillment_user-> get_email();
    $subject = 'New comment: proposal ' . $quote-> obtener_id();
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
    $message = '
    <html>
    <body>
    <h5>Quote:</h5>
    <p><a href="http://www.elogicportal.com/fullfillment/profile/edit_quote/' . $quote-> obtener_id() . '">' . $quote-> obtener_id() . '</a></p>
    <h5>Comment:</h5>
    <p>' . nl2br($_POST['comment']) . '</p>
    </body>
    </html>
    ';
    mail($to, $subject, $message, $headers);
  }
}
$fullfillment_users = UserFullFillmentRepository::get_all_project_management_users(ConnectionFullFillment::get_connection());
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
  <p>' . nl2br($_POST['comment']) . '</p>
  </body>
  </html>
  ';
  mail($to, $subject, $message, $headers);
}
Connection::close_connection();
ConnectionFullFillment::close_connection();

echo json_encode(array(
  'id_fulfillment_project'=> $_POST['id_fulfillment_project']
));
?>
