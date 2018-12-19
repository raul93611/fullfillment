<?php
ConnectionFullFillment::open_connection();
$provider_subitem = RepositorioProviderSubitemFullFillment::obtener_provider_subitem_por_id(ConnectionFullFillment::get_connection(),$id_provider_subitem);
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $provider_subitem-> obtener_id_subitem());
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
$cotizacion_recuperada = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $item-> obtener_id_rfq());
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_provider_subitem" value="<?php echo $id_provider_subitem; ?>">
<input type="hidden" name="id_rfq" value="<?php echo $item-> obtener_id_rfq(); ?>">

<div class="card-body">
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="provider">Provider:</label>
        <input type="text" class="form-control form-control-sm" id="provider" name="provider" placeholder="Provider ..." autofocus required value="<?php echo $provider_subitem-> obtener_provider(); ?>">
        <input type="hidden" name="provider_original" value="<?php echo $provider_subitem-> obtener_provider(); ?>">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" step=".01" class="form-control form-control-sm" id="price" name="price" required value="<?php echo $provider_subitem-> obtener_price(); ?>">
        <input type="hidden" name="price_original" value="<?php echo $provider_subitem-> obtener_price(); ?>">
      </div>
    </div>
  </div>
</div>
<div class="card-footer">
  <button type="submit" class="btn btn-success" name="guardar_cambios_provider_subitem"><i class="fa fa-check"></i> Save</button>
  <a href="<?php echo EDIT_QUOTE . $item-> obtener_id_rfq() . '#caja_items'; ?>" class="btn btn-info"><i class="fa fa-times"></i> Cancel</a>
  <a href="<?php echo DELETE_PROVIDER_SUBITEM . $id_provider_subitem; ?>" class="delete_provider_subitem_button btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
</div>
