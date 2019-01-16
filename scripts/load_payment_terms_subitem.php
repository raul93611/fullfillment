<?php
ConnectionFullFillment::open_connection();
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $id_subitem);
$extra_subitem = ExtraSubitemRepository::get_extra_subitem_by_id_subitem(ConnectionFullFillment::get_connection(), $id_subitem);
ConnectionFullFillment::close_connection();
$payment_terms = explode('|', $extra_subitem-> get_payment_terms());
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
<input type="hidden" name="id_extra_subitem" value="<?php echo $extra_subitem-> get_id(); ?>">
