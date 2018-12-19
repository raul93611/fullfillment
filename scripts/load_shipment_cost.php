<?php
ConnectionFullFillment::open_connection();
$purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $id_purchase_order);
ConnectionFullFillment::close_connection();
?>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="shipment_cost">Shipment cost:</label>
      <input type="number" step=".01" class="form-control form-control-sm" name="shipment_cost" value="<?php echo $purchase_order-> get_shipment_cost(); ?>">
    </div>
  </div>
  <input type="hidden" name="id_purchase_order" value="<?php echo $purchase_order-> get_id(); ?>">
</div>
