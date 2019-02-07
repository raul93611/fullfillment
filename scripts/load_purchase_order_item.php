<?php
ConnectionFullFillment::open_connection();
$purchase_order_item = PurchaseOrderItemRepository::get_purchase_order_item_by_id(ConnectionFullFillment::get_connection(), $id_purchase_order_item);
$purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $purchase_order_item-> get_id());
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_purchase_order_item" value="<?php echo $purchase_order_item-> get_id(); ?>">
<input type="hidden" name="id_purchase_order" value="<?php echo $purchase_order_item-> get_id_purchase_order(); ?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="part_number">Part number:</label>
        <input type="text" name="part_number" class="form-control form-control-sm" id="part_number" value="<?php echo $purchase_order_item-> get_part_number(); ?>">
      </div>
      <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" class="form-control form-control-sm" id="quantity" value="<?php echo $purchase_order_item-> get_quantity(); ?>">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" rows="5" id="description" class="form-control form-control-sm"><?php echo $purchase_order_item-> get_description(); ?></textarea>
      </div>
      <div class="form-group">
        <label for="unit_price">Unit price:</label>
        <input type="number" step=".01" name="unit_price" id="unit_price" class="form-control form-control-sm" value="<?php echo $purchase_order_item-> get_unit_price(); ?>">
      </div>
    </div>
  </div>
</div>
