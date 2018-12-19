<?php
ConnectionFullFillment::open_connection();
$purchase_order = new PurchaseOrder('', $id_rfq, '', '', '', '', '', '', '', '', '', 0, 0, 0, '');
$id_purchase_order = PurchaseOrderRepository::insert_purchase_order(ConnectionFullFillment::get_connection(), $purchase_order);
ConnectionFullFillment::close_connection();
Redirection::redirect1(PURCHASE_ORDER . $id_purchase_order);
?>
