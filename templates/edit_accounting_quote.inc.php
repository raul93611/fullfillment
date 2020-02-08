<?php
ConnectionFullFillment::open_connection();
$quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $id_rfq);
$rfq_fullfillment_part = RfqFullFillmentPartRepository::get_rfq_fullfillment_part_by_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
ConnectionFullFillment::close_connection();
$due_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($rfq_fullfillment_part-> get_due_date());
$order_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($rfq_fullfillment_part-> get_order_date());
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
          include_once 'templates/accounting_quote_edition.inc.php';
          ?>
        </div>
      </div>
    </div>
  </section>
</div>
<!--*************************************************EDIT ACCOUNTING SUBITEM PRICE MODAL*************************************************************-->
<div class="modal fade" id="edit_extra_cost_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id_rfq" form="edit_extra_cost_form" value="<?php echo $quote-> obtener_id(); ?>">
      <form id="edit_extra_cost_form" method="post" action="">

      </form>
    </div>
  </div>
</div>
<!--*************************************************NEW EXTRA COST*************************************************************-->
<div class="modal fade" id="new_extra_cost_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="new_extra_cost_form" method="post" action="">
        <div class="modal-body">
          <input type="hidden" name="id_rfq" value="<?php echo $quote-> obtener_id(); ?>">
          <div class="form-group">
            <label>Description:</label>
            <input type="text" name="description" class="form-control form-control-sm" value="">
          </div>
          <div class="form-group">
            <label>Cost:</label>
            <input type="number" step=".01" name="cost" class="form-control form-control-sm" value="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="save_new_extra_cost" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--*************************************************EDIT ACCOUNTING SUBITEM PRICE MODAL*************************************************************-->
<div class="modal fade" id="edit_accounting_subitem_price_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id_rfq" form="edit_accounting_subitem_price_form" value="<?php echo $quote-> obtener_id(); ?>">
      <form id="edit_accounting_subitem_price_form" method="post" action="">

      </form>
    </div>
  </div>
</div>
<!--*************************************************EDIT ACCOUNTING ITEM PRICE MODAL*************************************************************-->
<div class="modal fade" id="edit_accounting_item_price_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id_rfq" form="edit_accounting_item_price_form" value="<?php echo $quote-> obtener_id(); ?>">
      <form id="edit_accounting_item_price_form" method="post" action="">

      </form>
    </div>
  </div>
</div>
<!--*************************************************NEW ACCOUNTING SUBITEM PRICE MODAL*************************************************************-->
<div class="modal fade" id="new_accounting_subitem_price_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new_accounting_subitem_price_form" method="post" action="">
          <input type="hidden" name="id_subitem" value="">
          <input type="hidden" name="id_rfq" value="<?php echo $quote-> obtener_id(); ?>">
          <div class="form-group">
            <label>Company:</label>
            <input type="text" class="form-control form-control-sm" name="company" value="">
          </div>
          <div class="form-group">
            <label>Quantity:</label>
            <input type="number" class="form-control form-control-sm" name="quantity" value="">
          </div>
          <div class="form-group">
            <label>Unit cost:</label>
            <input type="number" step=".01" class="form-control form-control-sm" name="unit_cost" value="">
          </div>
          <div class="form-group">
            <label>Other cost:</label>
            <input type="number" step=".01" class="form-control form-control-sm" name="other_cost" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" name="save_new_accounting_subitem_price" form="new_accounting_subitem_price_form" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************NEW ACCOUNTING ITEM PRICE MODAL*************************************************************-->
<div class="modal fade" id="new_accounting_item_price_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new_accounting_item_price_form" method="post" action="">
          <input type="hidden" name="id_item" value="">
          <input type="hidden" name="id_rfq" value="<?php echo $quote-> obtener_id(); ?>">
          <div class="form-group">
            <label>Company:</label>
            <input type="text" class="form-control form-control-sm" name="company" value="">
          </div>
          <div class="form-group">
            <label>Quantity:</label>
            <input type="number" class="form-control form-control-sm" name="quantity" value="">
          </div>
          <div class="form-group">
            <label>Unit cost:</label>
            <input type="number" step=".01" class="form-control form-control-sm" name="unit_cost" value="">
          </div>
          <div class="form-group">
            <label>Other cost:</label>
            <input type="number" step=".01" class="form-control form-control-sm" name="other_cost" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" name="save_new_accounting_item_price" form="new_accounting_item_price_form" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
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
