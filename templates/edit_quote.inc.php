<?php
ConnectionFullFillment::open_connection();
$quote = RepositorioRfqFullfillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $id_rfq);
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
