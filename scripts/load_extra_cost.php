<?php
ConnectionFullFillment::open_connection();
$extra_cost = ExtraCostRepository::get_extra_cost_by_id(ConnectionFullFillment::get_connection(), $id_extra_cost);
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_extra_cost" value="<?php echo $extra_cost-> get_id(); ?>">
<div class="modal-body">
  <div class="form-group">
    <label>Description:</label>
    <input type="text" class="form-control form-control-sm" name="description" value="<?php echo $extra_cost-> get_description(); ?>">
  </div>
  <div class="form-group">
    <label>Cost:</label>
    <input type="number" step=".01" class="form-control form-control-sm" name="cost" value="<?php echo $extra_cost-> get_cost(); ?>">
  </div>
</div>
<div class="modal-footer">
  <button type="submit" name="save_edit_extra_cost" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
  <button type="button" class="btn btn-danger remove_extra_cost_button" name="button" data="<?php echo $extra_cost-> get_id(); ?>"><i class="fas fa-trash"></i> Delete</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
</div>
