<?php
ConnectionFullFillment::open_connection();
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $id_item);
$extra_item = ExtraItemRepository::get_extra_item_by_id_item(ConnectionFullFillment::get_connection(), $id_item);
ConnectionFullFillment::close_connection();
$payment_terms = explode('|', $extra_item-> get_payment_terms());
?>
<div class="row">
  <div class="col-md-2">

  </div>
  <div class="col-md-8">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" name="payment_terms[]" class="custom-control-input" id="po" value="po"
      <?php
      foreach ($payment_terms as $key => $payment_term) {
        if($payment_term == 'po'){
          echo 'checked';
        }
      }
      ?>
      >
      <label class="custom-control-label" for="po">P.O.</label>
    </div>
    <div class="custom-control custom-checkbox">
      <input type="checkbox" name="payment_terms[]" class="custom-control-input" id="cash" value="cash"
      <?php
      foreach ($payment_terms as $key => $payment_term) {
        if($payment_term == 'cash'){
          echo 'checked';
        }
      }
      ?>
      >
      <label class="custom-control-label" for="cash">Cash</label>
    </div>
  </div>
  <div class="col-md-2">

  </div>
</div>
<input type="hidden" name="id_extra_item" value="<?php echo $extra_item-> get_id(); ?>">
