<input type="hidden" name="id_item" value="<?php echo $id_item; ?>">
<?php
ConnectionFullFillment::open_connection();
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $id_item);
ConnectionFullFillment::close_connection();
?>
<div class="card-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="provider">Provider:</label>
        <input type="text" class="form-control form-control-sm" id="provider" name="provider" placeholder="Provider ..." autofocus required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" step=".01" class="form-control form-control-sm" id="price" name="price" required>
      </div>
    </div>
  </div>
</div>
<div class="card-footer">
  <button type="submit" class="btn btn-success" name="guardar_provider"><i class="fa fa-check"></i> Save</button>
  <a href="<?php echo EDIT_QUOTE . $item-> obtener_id_rfq() . '#caja_items'; ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
</div>
