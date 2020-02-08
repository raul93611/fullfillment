<?php
session_start();
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
MemberRepository::remove_member(ConnectionFullFillment::get_connection(), $_POST['id_member']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'result'=> 'ok'
));
?>
