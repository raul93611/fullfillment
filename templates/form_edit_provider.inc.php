<?php
ConnectionFullFillment::open_connection();
$provider = RepositorioProviderFullFillment::obtener_provider_por_id(ConnectionFullFillment::get_connection(), $id_provider);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $provider-> obtener_id_item());
$cotizacion_recuperada = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $item-> obtener_id_rfq());
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_provider" value="<?php echo $id_provider; ?>">
<input type="hidden" name="id_rfq" value="<?php echo $item-> obtener_id_rfq(); ?>">
<div class="card-body">
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="provider">Provider:</label>
        <input type="text" class="form-control form-control-sm" id="provider" name="provider" placeholder="Provider ..." autofocus required value="<?php echo $provider-> obtener_provider(); ?>">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" step=".01" class="form-control form-control-sm" id="price" name="price" required value="<?php echo $provider-> obtener_price(); ?>">
      </div>
    </div>
  </div>
</div>
<div class="card-footer">
  <button type="submit" class="btn btn-success" name="guardar_cambios_provider"><i class="fa fa-check"></i> Save</button>
  <a href="<?php echo EDIT_QUOTE . $item-> obtener_id_rfq(); ?>" class="btn btn-info"><i class="fa fa-times"></i> Cancel</a>
  <a href="<?php echo DELETE_PROVIDER . $id_provider; ?>" class="delete_provider_item_button btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
</div>
