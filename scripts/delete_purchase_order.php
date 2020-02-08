<?php
ConnectionFullFillment::open_connection();
$purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $id_purchase_order);
$purchase_order_items = PurchaseOrderItemRepository::get_all_purchase_order_items(ConnectionFullFillment::get_connection(), $id_purchase_order);
if (count($purchase_order_items)) {
  foreach ($purchase_order_items as $key => $purchase_order_item) {
    PurchaseOrderItemRepository::remove_purchase_order_item(ConnectionFullFillment::get_connection(), $purchase_order_item-> get_id());
  }
}
PurchaseOrderRepository::remove_purchase_order(ConnectionFullFillment::get_connection(),$purchase_order-> get_id());
ConnectionFullFillment::close_connection();
Redirection::redirect(EDIT_QUOTE . $purchase_order-> get_id_rfq());
?>
