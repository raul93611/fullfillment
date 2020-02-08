<?php
session_start();
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
ProjectDateRepository::remove_date(ConnectionFullFillment::get_connection(), $_POST['id_project_date']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> 'ok'
));
?>
