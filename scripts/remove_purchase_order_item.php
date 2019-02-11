<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$purchase_order_item = PurchaseOrderItemRepository::get_purchase_order_item_by_id(ConnectionFullFillment::get_connection(), $_POST['id_purchase_order_item']);
$id_purchase_order = $purchase_order_item-> get_id_purchase_order();
PurchaseOrderItemRepository::remove_purchase_order_item(ConnectionFullFillment::get_connection(), $_POST['id_purchase_order_item']);
$purchase_order_items = PurchaseOrderItemRepository::get_all_purchase_order_items(ConnectionFullFillment::get_connection(), $id_purchase_order);
$subtotal = 0;
if(count($purchase_order_items)){
  foreach ($purchase_order_items as $key => $purchase_order_item) {
    $subtotal += $purchase_order_item-> get_amount();
  }
}
PurchaseOrderRepository::set_subtotal(ConnectionFullFillment::get_connection(), $subtotal, $id_purchase_order);
$purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $id_purchase_order);
$total = $purchase_order-> get_shipment_cost() + $purchase_order-> get_subtotal();
PurchaseOrderRepository::set_total(ConnectionFullFillment::get_connection(), $total, $id_purchase_order);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_purchase_order'=> $id_purchase_order
));
?>
