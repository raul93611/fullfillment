<?php
ConnectionFullFillment::open_connection();
$work_order_item = WorkOrderItemRepository::get_work_order_item_by_id(ConnectionFullFillment::get_connection(), $id_work_order_item);
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_work_order_item" value="<?php echo $work_order_item-> get_id(); ?>">
<input type="hidden" name="id_work_order" value="<?php echo $work_order_item-> get_id_work_order(); ?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="equipment">Equipment:</label>
        <textarea name="equipment" rows="5" class="form-control form-control-sm"><?php echo $work_order_item-> get_equipment(); ?></textarea>
      </div>
    </div>
  </div>
</div>
