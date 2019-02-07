<?php
session_start();
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$edited_user = UserFullFillmentRepository::enable_user(ConnectionFullFillment::get_connection(), $_POST['id_user']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'result'=> '1'
));
?>
