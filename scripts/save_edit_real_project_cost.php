<?php
session_start();
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
RealProjectExtracostRepository::update_cost(ConnectionFullFillment::get_connection(), $_POST['cost'], $_POST['id_real_project_cost']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> '2'
));
?>
