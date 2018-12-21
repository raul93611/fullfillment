<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $_POST['id_item']);
$packing_slip_item = PackingSlipItemRepository::get_packing_slip_item_by_id_item(ConnectionFullFillment::get_connection(), $_POST['id_item']);
$packing_slip_subitems = PackingSlipSubitemRepository::get_packing_slip_subitems_by_id_packing_slip_item(ConnectionFullFillment::get_connection(), $packing_slip_item-> get_id());
if(count($packing_slip_subitems)){
  foreach ($packing_slip_subitems as $key => $packing_slip_subitem) {
    PackingSlipSubitemRepository::remove_packing_slip_subitem(ConnectionFullFillment::get_connection(), $packing_slip_subitem-> get_id());
  }
}
PackingSlipItemRepository::remove_packing_slip_item(ConnectionFullFillment::get_connection(), $packing_slip_item-> get_id());
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $item-> obtener_id_rfq()
));
?>
