<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$packing_slip_subitem = PackingSlipSubitemRepository::get_packing_slip_subitem_by_id_subitem(ConnectionFullFillment::get_connection(), $_POST['id_subitem']);
PackingSlipSubitemRepository::update_packing_slip_subitem(ConnectionFullFillment::get_connection(), $_POST['unit_type'], $_POST['back_order_quantity'], $packing_slip_subitem-> get_id());
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
