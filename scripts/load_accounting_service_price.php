<?php
ConnectionFullFillment::open_connection();
$accounting_service_price = AccountingServicePriceRepository::get_accounting_service_price_by_id(ConnectionFullFillment::get_connection(), $id_accounting_service_price);
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_accounting_service_price" value="<?php echo $accounting_service_price-> get_id(); ?>">
<div class="modal-body">
  <div class="form-group">
    <label>Company:</label>
    <input type="text" class="form-control form-control-sm" name="company" value="<?php echo $accounting_service_price-> get_company(); ?>">
  </div>
  <div class="form-group">
    <label>Quantity:</label>
    <input type="number" class="form-control form-control-sm" name="quantity" value="<?php echo $accounting_service_price-> get_quantity(); ?>">
  </div>
  <div class="form-group">
    <label>Unit cost:</label>
    <input type="number" step=".01" class="form-control form-control-sm" name="unit_cost" value="<?php echo $accounting_service_price-> get_unit_cost(); ?>">
  </div>
  <div class="form-group">
    <label>Other cost:</label>
    <input type="number" step=".01" class="form-control form-control-sm" name="other_cost" value="<?php echo $accounting_service_price-> get_other_cost(); ?>">
  </div>
</div>
<div class="modal-footer">
  <button type="submit" name="save_edit_accounting_service_price" form="edit_accounting_service_price_form" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
  <button type="button" data="<?php echo $accounting_service_price-> get_id(); ?>" class="remove_accounting_service_price_button btn btn-danger" name="button"><i class="fas fa-trash"></i> Delete</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
</div>
