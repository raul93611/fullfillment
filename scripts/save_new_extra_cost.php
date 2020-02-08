<?php
header('Content-Type: application/json');
$extra_cost = new ExtraCost('', $_POST['id_rfq'], $_POST['description'], $_POST['cost']);
ConnectionFullFillment::open_connection();
ExtraCostRepository::insert_extra_cost(ConnectionFullFillment::get_connection(), $extra_cost);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
