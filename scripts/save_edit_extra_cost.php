<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
ExtraCostRepository::update_extra_cost(ConnectionFullFillment::get_connection(), $_POST['description'], $_POST['cost'], $_POST['id_extra_cost']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
