<?php
ConnectionFullFillment::open_connection();
Conexion::abrir_conexion();
$quote = RepositorioRfq::obtener_cotizacion_por_id(Conexion::obtener_conexion(), $id_rfq);
Conexion::cerrar_conexion();
$rfq_fullfillment_part = RfqFullFillmentPartRepository::get_rfq_fullfillment_part_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
$po_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($rfq_fullfillment_part-> get_po_date());
$eta1 = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($rfq_fullfillment_part-> get_eta1());
$eta2 = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($rfq_fullfillment_part-> get_eta2());
$eta3 = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($rfq_fullfillment_part-> get_eta3());
ConnectionFullFillment::close_connection();
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-2">
          <h1>Proposal #<?php echo $quote-> obtener_id(); ?></h1>
        </div>
        <div class="col-sm-8 text-center">
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
          <?php
          include_once 'templates/quote_edition.inc.php';
          ?>
        </div>
      </div>
    </div>
  </section>
</div>
<!--*************************************************PURCHASE ORDERS MODAL*************************************************************-->
<div class="modal fade" id="orders_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
      <div class="modal-header">
        <h5 class="modal-title">Comments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        RepositorioRfqFullFillmentComment::escribir_comments($quote-> obtener_id());
        ?>
      </div>
    </div>
  </div>
</div>
<!--***********************************************MODAL PAYMENT TERMS ITEM*******************************-->
<div class="modal fade" id="payment_terms_item_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Payment terms</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="payment_terms_item_form" method="post">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="send_payment_terms_item" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--***********************************************MODAL PAYMENT TERMS SUBITEM*******************************-->
<div class="modal fade" id="payment_terms_subitem_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Payment terms</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="payment_terms_subitem_form" method="post">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="send_payment_terms_subitem" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
