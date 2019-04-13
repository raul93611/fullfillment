<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
ExtraServiceRepository::remove_extra_service(ConnectionFullFillment::get_connection(), $_POST['id_extra_service']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> 'id_rfq'
));
?>
