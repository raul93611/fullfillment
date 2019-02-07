<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $_POST['id_subitem']);
$packing_slip_item = PackingSlipItemRepository::get_packing_slip_item_by_id_item(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
$packing_slip_subitem = new PackingSlipSubitem('', $packing_slip_item-> get_id(), $_POST['id_subitem'], $_POST['unit_type'], $_POST['back_order_quantity']);
PackingSlipSubitemRepository::insert_packing_slip_subitem(ConnectionFullFillment::get_connection(), $packing_slip_subitem);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
