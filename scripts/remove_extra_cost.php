<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
ExtraCostRepository::remove_extra_cost(ConnectionFullFillment::get_connection(), $_POST['id_extra_cost']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> 'id_rfq'
));
?>
