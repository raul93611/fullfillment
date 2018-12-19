<?php
header('Content-Type: application/json');
$amount = $_POST['quantity'] * $_POST['unit_price'];
ConnectionFullFillment::open_connection();
PurchaseOrderItemRepository::update_purchase_order_item(ConnectionFullFillment::get_connection(), $_POST['id_purchase_order_item'], $_POST['part_number'], $_POST['quantity'], htmlspecialchars($_POST['description']), $_POST['unit_price'], $amount);
$purchase_order_items = PurchaseOrderItemRepository::get_all_purchase_order_items(ConnectionFullFillment::get_connection(), $_POST['id_purchase_order']);
$subtotal = 0;
if(count($purchase_order_items)){
  foreach ($purchase_order_items as $key => $purchase_order_item) {
    $subtotal += $purchase_order_item-> get_amount();
  }
}
PurchaseOrderRepository::set_subtotal(ConnectionFullFillment::get_connection(), $subtotal, $_POST['id_purchase_order']);
$purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $_POST['id_purchase_order']);
$total = $purchase_order-> get_shipment_cost() + $purchase_order-> get_subtotal();
PurchaseOrderRepository::set_total(ConnectionFullFillment::get_connection(), $total, $_POST['id_purchase_order']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_purchase_order'=> $_POST['id_purchase_order']
));
?>
