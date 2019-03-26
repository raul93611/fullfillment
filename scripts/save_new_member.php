<?php
session_start();
header('Content-Type: application/json');
$member = new Member('', $_POST['id_fulfillment_project'], $_POST['names']);
ConnectionFullFillment::open_connection();
MemberRepository::insert_member(ConnectionFullFillment::get_connection(), $member);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'result' => 'ok'
));
?>
