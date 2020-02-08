<?php
session_start();
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
MemberRepository::update_member(ConnectionFullFillment::get_connection(), $_POST['names'], $_POST['id_member']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> '2'
));
?>
