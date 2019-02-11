<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$packing_slip_item = PackingSlipItemRepository::get_packing_slip_item_by_id_item(ConnectionFullFillment::get_connection(), $_POST['id_item']);
PackingSlipItemRepository::update_packing_slip_item(ConnectionFullFillment::get_connection(), $_POST['unit_type'], $_POST['back_order_quantity'], $packing_slip_item-> get_id());
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
