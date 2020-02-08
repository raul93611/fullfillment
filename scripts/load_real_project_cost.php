<?php
session_start();
ConnectionFullFillment::open_connection();
$real_project_cost = RealProjectExtracostRepository::get_cost_by_id(ConnectionFullFillment::get_connection(), $id_real_project_cost);
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_real_project_cost" value="<?php echo $id_real_project_cost; ?>">
<div class="modal-body">
  <div class="form-group">
    <label>Cost:</label>
    <input type="number" step=".01" name="cost" class="form-control form-control-sm" value="<?php echo $real_project_cost-> get_cost(); ?>">
  </div>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-success" name="button"><i class="fas fa-check"></i> Save</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
</div>
<?php
?>
