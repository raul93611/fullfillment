<?php
ConnectionFullFillment::open_connection();
$quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $id_rfq);
$rfq_fullfillment_part = RfqFullFillmentPartRepository::get_rfq_fullfillment_part_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
$po_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($rfq_fullfillment_part-> get_po_date());
$eta = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($rfq_fullfillment_part-> get_eta());
ConnectionFullFillment::close_connection();
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-2">
          <h1>Internal quote</h1>
        </div>
        <div class="col-sm-8 text-center">
          <a href="<?php echo PDF_ITEMS_TABLE . $quote-> obtener_id(); ?>" target="_blank" class="btn btn-primary"><i class="fas fa-file"></i> PDF</a>
          <button type="button" id="quote_comments" class="btn btn-primary"><i class="fas fa-comments"></i> Comments(
            <?php
            ConnectionFullFillment::open_connection();
            echo RepositorioRfqFullFillmentComment::contar_todos_comentarios_quote(ConnectionFullFillment::get_connection(), $quote-> obtener_id());
            ConnectionFullFillment::close_connection();
            ?>)
          </button>
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
<!--*************************************************MODAL TO SHOW COMMENTS*************************************************************-->
<div class="modal fade" id="todos_commentarios_quote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <?php
        RepositorioRfqFullFillmentComment::escribir_comments($quote-> obtener_id());
        ?>
      </div>
    </div>
  </div>
</div>
<!--******************************************************MODAL TO ADD INFO********************************************-->
<div class="modal fade" id="info_rfq_fullfillment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="info_rfq_fullfillment_form" method="post" enctype="multipart/form-data" action="<?php echo SAVE_RFQ_FULLFILLMENT_INFO; ?>">
          <div class="form-group">
            <label for="rfq_fullfillment_part_name">Name:</label>
            <input type="text" class="form-control form-control-sm" name="rfq_fullfillment_part_name" id="rfq_fullfillment_part_name" value="<?php echo $rfq_fullfillment_part-> get_name(); ?>">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="po_number">P.O. number:</label>
                <input type="text" class="form-control form-control-sm" name="po_number" id="po_number" value="<?php echo $rfq_fullfillment_part-> get_po_number(); ?>">
              </div>
              <div class="form-group">
                <label for="po_date">P.O. date:</label>
                <input type="text" class="form-control form-control-sm" name="po_date" id="po_date" value="<?php if($po_date != '00/00/0000'){echo $po_date;} ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="business_classification">Business classification:</label>
                <select class="form-control form-control-sm" name="business_classification" id="business_classification">
                  <option value="small_business" <?php if($rfq_fullfillment_part-> get_business_classification() == 'small_business'){echo 'selected';} ?>>Small business</option>
                  <option value="8a" <?php if($rfq_fullfillment_part-> get_business_classification() == '8a'){echo 'selected';} ?>>8A</option>
                  <option value="hubzone" <?php if($rfq_fullfillment_part-> get_business_classification() == 'hubzone'){echo 'selected';} ?>>HUBZONE</option>
                  <option value="full_and_open" <?php if($rfq_fullfillment_part-> get_business_classification() == 'full_and_open'){echo 'selected';} ?>>Full and open</option>
                  <option value="gsa" <?php if($rfq_fullfillment_part-> get_business_classification() == 'gsa'){echo 'selected';} ?>>GSA</option>
                </select>
              </div>
              <div class="form-group">
                <label for="eta">ETA:</label>
              <input type="text" class="form-control form-control-sm" name="eta" id="eta" value="<?php if($eta != '00/00/0000'){echo $eta;} ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="equipment_amount">Equipment amount:</label>
                <input type="number" step=".01" class="form-control form-control-sm" readonly id="equipment_amount">
              </div>
              <div class="form-group">
                <label for="consolidate_others">Consolidate & others:</label>
                <input type="number" step=".01" class="form-control form-control-sm" name="consolidate_others" id="consolidate_others" value="<?php echo $rfq_fullfillment_part-> get_consolidate_others(); ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="vendors_estimate">Vendors estimate:</label>
                <input type="number" step=".01" class="form-control form-control-sm" readonly id="vendors_estimate">
              </div>
              <div class="form-group">
                <label for="total_vendor_cost">Total vendor cost:</label>
                <input type="number" step=".01" class="form-control form-control-sm" readonly name="total_vendor_cost" id="total_vendor_cost" value="<?php echo $rfq_fullfillment_part-> get_total_vendor_cost(); ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="rfq_fullfillment_part_fedbid">FedBid:</label>
                <input type="number" step=".01" class="form-control form-control-sm" <?php if($quote-> obtener_canal() != 'FedBid'){echo 'readonly';} ?> name="rfq_fullfillment_part_fedbid" id="rfq_fullfillment_part_fedbid" value="<?php echo $rfq_fullfillment_part-> get_fedbid(); ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="estimated_final_cost">Estimated final cost:</label>
                <input type="number" step=".01" class="form-control form-control-sm" readonly name="estimated_final_cost" id="estimated_final_cost" value="<?php echo $rfq_fullfillment_part-> get_estimated_final_cost(); ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="estimated_profit_g">Estimated profit(G):</label>
                <input type="number" step=".01" class="form-control form-control-sm" readonly name="estimated_profit_g" id="estimated_profit_g" value="<?php echo $rfq_fullfillment_part-> get_estimated_profit_g(); ?>">
              </div>
              <div class="form-group">
                <label for="estimated_profit_s">Estimated profit(S):</label>
                <input type="number" step=".01" class="form-control form-control-sm" readonly name="estimated_profit_s" id="estimated_profit_s" value="<?php echo $rfq_fullfillment_part-> get_estimated_profit_s(); ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="percent_g">Percent(G):</label>
                <input type="number" step=".01" class="form-control form-control-sm" readonly name="percent_g" id="percent_g" value="<?php echo $rfq_fullfillment_part-> get_percent_g(); ?>">
              </div>
              <div class="form-group">
                <label for="percent_s">Percent(S):</label>
                <input type="number" step=".01" class="form-control form-control-sm" readonly name="percent_s" id="percent_s" value="<?php echo $rfq_fullfillment_part-> get_percent_s(); ?>">
              </div>
            </div>
          </div>
          <input type="hidden" name="id_rfq_fullfillment_part" value="<?php echo $rfq_fullfillment_part-> get_id(); ?>">
          <input type="hidden" name="id_rfq" value="<?php echo $quote-> obtener_id(); ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" name="save_rfq_fullfillment_info" form="info_rfq_fullfillment_form" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
