<?php
header('Content-Type: application/json');
$extra_service = new ExtraService('', $_POST['id_fulfillment_project'], $_POST['description'], $_POST['cost']);
ConnectionFullFillment::open_connection();
ExtraServiceRepository::insert_extra_service(ConnectionFullFillment::get_connection(), $extra_service);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_fulfillment_project'=> $_POST['id_fulfillment_project']
));
?>
