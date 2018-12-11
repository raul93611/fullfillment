<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $_POST['id_purchase_order']);
$total = $purchase_order-> get_subtotal() + $_POST['shipment_cost'];
PurchaseOrderRepository::set_shipment_cost_and_total(ConnectionFullFillment::get_connection(), $_POST['shipment_cost'], $total, $_POST['id_purchase_order']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_purchase_order'=> $_POST['id_purchase_order']
));
?>
