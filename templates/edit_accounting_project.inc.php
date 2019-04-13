<?php
Connection::open_connection();
$project = ProjectRepository::get_project_by_id(Connection::get_connection(), $id_project);
$services = ServiceRepository::get_services_by_id_project(Connection::get_connection(), $id_project);
Connection::close_connection();
ConnectionFullFillment::open_connection();
$fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id_project(ConnectionFullFillment::get_connection(), $id_project);
$number_comments = ProjectCommentRepository::count_all_comments_by_project(ConnectionFullFillment::get_connection(), $fulfillment_project-> get_id());
ConnectionFullFillment::close_connection();
$due_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($fulfillment_project-> get_due_date());
$order_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($fulfillment_project-> get_order_date());
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-6">
          <?php
          if($project-> get_previous_contract()){
            ?>
            <h4>Previous contract: #<small><?php echo $project-> get_id(); ?></small></h4>
            <?php
          }else {
            ?>
            <h1>Project: #<small><?php echo $project-> get_id(); ?></small></h1>
            <?php
          }
          ?>
        </div>
        <div id="project_comments" class="col-md-6 text-right">
          <button class="btn btn-primary" id="show_project_comments_button" type="button" name="button"><i class="far fa-comment"></i> Comments(<?php echo $number_comments; ?>)</button>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php
          include_once 'templates/accounting_project_edition.inc.php';
          ?>
        </div>
      </div>
    </div>
  </section>
</div>
<!--*************************************************EDIT project extra cost MODAL*************************************************************-->
<div class="modal fade" id="edit_extra_service_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id_fulfillment_project" form="edit_extra_service_form" value="<?php echo $fulfillment_project-> get_id(); ?>">
      <form id="edit_extra_service_form" method="post" action="">

      </form>
    </div>
  </div>
</div>
<!--*************************************************NEW EXTRA service*************************************************************-->
<div class="modal fade" id="new_extra_service_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="new_extra_service_form" method="post" action="">
        <div class="modal-body">
          <input type="hidden" name="id_fulfillment_project" value="<?php echo $fulfillment_project-> get_id(); ?>">
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
          <button type="submit" name="save_new_extra_service" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--*************************************************EDIT ACCOUNTING service PRICE MODAL*************************************************************-->
<div class="modal fade" id="edit_accounting_service_price_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id_fulfillment_project" form="edit_accounting_service_price_form" value="<?php echo $fulfillment_project-> get_id(); ?>">
      <form id="edit_accounting_service_price_form" method="post" action="">

      </form>
    </div>
  </div>
</div>
<!--*************************************************NEW ACCOUNTING service PRICE MODAL*************************************************************-->
<div class="modal fade" id="new_accounting_service_price_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="new_accounting_service_price_form" method="post" action="">
          <input type="hidden" name="id_service" value="">
          <input type="hidden" name="id_fulfillment_project" value="<?php echo $fulfillment_project-> get_id(); ?>">
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
        <button type="submit" name="save_new_accounting_service_price" form="new_accounting_service_price_form" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--*************************************************MODAL TO SHOW COMMENTS*************************************************************-->
<div class="modal fade" id="all_project_comments_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        ProjectCommentRepository::print_all_comments_by_project($fulfillment_project-> get_id());
        ?>
      </div>
    </div>
  </div>
</div>
<!--*************************************new comment**************************-->
<div class="modal fade" id="new_project_comment_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="new_project_comment_form" action="" method="post">
        <input type="hidden" name="id_fulfillment_project" value="<?php echo $fulfillment_project-> get_id(); ?>">
        <div class="modal-body">
          <div class="form-group">
            <textarea name="comment" rows="5" class="form-control form-control-sm"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="button"><i class="fas fa-check"></i> Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
