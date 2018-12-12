<?php
ConnectionFullFillment::open_connection();
$purchase_orders = PurchaseOrderRepository::get_all_purchase_orders_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
if(count($purchase_orders)){
  foreach ($purchase_orders as $key => $purchase_order) {
    ?>
    <a href="<?php echo PURCHASE_ORDER . $purchase_order-> get_id(); ?>" class="list-group-item list-group-item-action">
      <?php
      if(empty($purchase_order-> get_po_number())){
        echo 'New';
      }else {
        echo $purchase_order-> get_po_number();
      }
      ?>
    </a>
    <?php
  }
}
ConnectionFullFillment::close_connection();
?>
