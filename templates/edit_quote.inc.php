<?php
ConnectionFullFillment::open_connection();
$quote = RepositorioRfqFullfillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $id_rfq);
$rfq_fullfillment_part = RfqFullFillmentPartRepository::get_rfq_fullfillment_part_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
ConnectionFullFillment::close_connection();
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
          <h1>Internal quote</h1>
        </div>
        <div class="col-sm-6">
        </div>
        <div class="col-sm-2">
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-highlighter"></i> Enter the data</h3>
            </div>
            <form role="form" id="form_edited_quote" method="post" enctype="multipart/form-data" action="<?php echo SAVE_QUOTE; ?>">
              <?php
              include_once 'templates/quote_edition.inc.php';
              include_once 'templates/quote_edition2.inc.php';
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--*************************************************MODAL COMMENT*************************************************************-->
<div class="modal fade" id="nuevo_comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_nuevo_comment" method="post" enctype="multipart/form-data" action="<?php echo SAVE_COMMENT_RFQ; ?>">
          <div class="form-group">
            <label for="comment_rfq">Comment:</label>
            <textarea class="form-control form-control-sm" name="comment_rfq" rows="10" id="comment_rfq" autofocus></textarea>
          </div>
          <input type="hidden" name="id_rfq" value="<?php echo $quote-> obtener_id(); ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" name="guardar_comment" form="form_nuevo_comment" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
