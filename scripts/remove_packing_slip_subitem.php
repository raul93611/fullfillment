<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $_POST['id_subitem']);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
$packing_slip_subitem = PackingSlipSubitemRepository::get_packing_slip_subitem_by_id_subitem(ConnectionFullFillment::get_connection(), $_POST['id_subitem']);
PackingSlipSubitemRepository::remove_packing_slip_subitem(ConnectionFullFillment::get_connection(), $packing_slip_subitem-> get_id());
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $item-> obtener_id_rfq()
));
?>
