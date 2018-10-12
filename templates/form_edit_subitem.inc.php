<?php
ConnectionFullFillment::open_connection();
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $id_subitem);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
$cotizacion_recuperada = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $item-> obtener_id_rfq());
Conexion::cerrar_conexion();
?>
<input type="hidden" name="id_subitem" value="<?php echo $id_subitem; ?>">
<input type="hidden" name="id_rfq" value="<?php echo $item->obtener_id_rfq(); ?>">
<div class="card-body">
  <div class="row">
    <div class="col">
      <h2>Project specifications</h2>
      <div class="form-group">
        <label for="brand_project">Brand:</label>
        <input type="text" class="form-control form-control-sm" id="brand_project" name="brand_project" placeholder="Brand ..." autofocus value="<?php echo $subitem->obtener_brand_project(); ?>">
      </div>
      <div class="form-group">
        <label for="part_number_project">Part #:</label>
        <input type="text" class="form-control form-control-sm" id="part_number_project" name="part_number_project" placeholder="Part # ..." value="<?php echo $subitem->obtener_part_number_project(); ?>">
      </div>
      <div class="form-group">
        <label for="description_project">Description:</label>
        <textarea class="form-control form-control-sm" rows="5" placeholder="Enter description ..." id="description_project" name="description_project"><?php echo $subitem->obtener_description_project(); ?></textarea>
      </div>
    </div>
    <div class="col">
      <h2>E-logic proposal</h2>
      <div class="form-group">
        <label for="brand">Brand:</label>
        <input type="text" class="form-control form-control-sm" id="brand" name="brand" placeholder="Brand ..." autofocus value="<?php echo $subitem->obtener_brand(); ?>">
      </div>
      <div class="form-group">
        <label for="part_number">Part #:</label>
        <input type="text" class="form-control form-control-sm" id="part_number" name="part_number" placeholder="Part # ..." value="<?php echo $subitem->obtener_part_number(); ?>">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control form-control-sm" rows="5" placeholder="Enter description ..." id="description" name="description"><?php echo $subitem-> obtener_description(); ?></textarea>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="quantity">Quantity:</label>
    <input type="number" class="form-control form-control-sm" id="quantity" name="quantity" required value="<?php echo $subitem->obtener_quantity(); ?>">
  </div>
  <div class="form-group">
    <label for="comments">Comments:</label>
    <textarea class="form-control form-control-sm" rows="5" placeholder="Enter comments ..." id="comments" name="comments"><?php echo $subitem->obtener_comments(); ?></textarea>
  </div>
  <div class="form-group">
    <label for="website">Website:</label>
    <input type="text" class="form-control form-control-sm" id="website" name="website" placeholder="Website ..." value="<?php echo $subitem->obtener_website(); ?>">
  </div>
</div>
<div class="card-footer">
  <button type="submit" class="btn btn-success" name="guardar_cambios_subitem"><i class="fa fa-check"></i> Save</button>
  <a href="<?php echo EDIT_QUOTE . $item-> obtener_id_rfq(); ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
</div>
