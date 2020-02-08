<?php
ConnectionFullFillment::open_connection();
$work_order_item_detail = WorkOrderItemDetailRepository::get_work_order_item_detail_by_id(ConnectionFullFillment::get_connection(), $id_work_order_item_detail);
$work_order_item = WorkOrderItemRepository::get_work_order_item_by_id(ConnectionFullFillment::get_connection(), $work_order_item_detail-> get_id_work_order_item());
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_work_order" value="<?php echo $work_order_item-> get_id_work_order(); ?>">
<input type="hidden" name="id_work_order_item_detail" id="id_work_order_item_detail" value="<?php echo $id_work_order_item_detail; ?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="detail_name">Detail name:</label>
        <input type="text" name="detail_name" class="form-control form-control-sm" value="<?php echo $work_order_item_detail-> get_detail_name(); ?>">
      </div>
      <div class="form-group">
        <label for="detail">Detail:</label>
        <input type="text" name="detail" class="form-control form-control-sm" value="<?php echo $work_order_item_detail-> get_detail(); ?>">
      </div>
      <div class="form-group">
        <label for="keycode">Keycode:</label>
        <input type="text" name="keycode" class="form-control form-control-sm" value="<?php echo $work_order_item_detail-> get_keycode(); ?>">
      </div>
      <div class="form-group">
        <label for="notes">Notes:</label>
        <input type="text" name="notes" class="form-control form-control-sm" value="<?php echo $work_order_item_detail-> get_notes(); ?>">
      </div>
      <div class="form-group">
        <label for="technitian">Technitian:</label>
        <input type="text" name="technitian" class="form-control form-control-sm" value="<?php echo $work_order_item_detail-> get_technitian(); ?>">
      </div>
    </div>
  </div>
</div>
