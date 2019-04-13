<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
ExtraServiceRepository::update_extra_service(ConnectionFullFillment::get_connection(), $_POST['description'], $_POST['cost'], $_POST['id_extra_service']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_fulfillment_project'=> $_POST['id_fulfillment_project']
));
?>
