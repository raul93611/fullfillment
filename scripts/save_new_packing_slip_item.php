<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$packing_slip_item = new PackingSlipItem('', $_POST['id_packing_slip'], $_POST['id_item'], $_POST['unit_type'], $_POST['back_order_quantity']);
PackingSlipItemRepository::insert_packing_slip_item(ConnectionFullFillment::get_connection(), $packing_slip_item);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
