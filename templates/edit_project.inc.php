<?php
Connection::open_connection();
$project = ProjectRepository::get_project_by_id(Connection::get_connection(), $id_project);
$services = ServiceRepository::get_services_by_id_project(Connection::get_connection(), $id_project);
$previous_contracts = ProjectRepository::get_all_previous_contracts(Connection::get_connection(), $project-> get_id());
Connection::close_connection();
ConnectionFullFillment::open_connection();
$fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id_project(ConnectionFullFillment::get_connection(), $id_project);
$number_comments = ProjectCommentRepository::count_all_comments_by_project(ConnectionFullFillment::get_connection(), $fulfillment_project-> get_id());
$real_project_costs = RealProjectExtracostRepository::get_all_costs_by_project(ConnectionFullFillment::get_connection(), $fulfillment_project-> get_id());
$total_real_project_cost = RealProjectExtracostRepository::get_total_cost(ConnectionFullFillment::get_connection(), $fulfillment_project-> get_id());
$members = MemberRepository::get_all_members_by_project(ConnectionFullFillment::get_connection(), $fulfillment_project-> get_id());
ConnectionFullFillment::close_connection();
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-6">
          <?php
          if($project-> get_previous_contract()){
            ?>
            <h3>Project: <a href="<?php echo EDIT_PROJECT . $project-> get_previous_contract(); ?>">#<small><?php echo $project-> get_previous_contract(); ?></small></a></h1>
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
          include_once 'templates/project_edition.inc.php';
          ?>
        </div>
      </div>
    </div>
  </section>
</div>
<!--*************************************project date**************************-->
<div class="modal fade" id="project_date_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="contenido">

      </div>
    </div>
  </div>
</div>
<!--*************************************project date**************************-->
<div class="modal fade" id="new_project_date_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="new_project_date_form" action="" method="post">
        <input type="hidden" name="id_fulfillment_project" value="<?php echo $fulfillment_project-> get_id(); ?>">
        <div class="modal-body">
          <div class="form-group">
            <label>Date:</label>
            <input type="text" name="date" readonly class="form-control form-control-sm" value="">
          </div>
          <div class="form-group">
            <label>Comment:</label>
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
<!--*************************************edit member**************************-->
<div class="modal fade" id="edit_member_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="edit_member_form" action="" method="post">

      </form>
    </div>
  </div>
</div>
<!--*************************************new member**************************-->
<div class="modal fade" id="new_member_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="new_member_form" action="" method="post">
        <input type="hidden" name="id_fulfillment_project" value="<?php echo $fulfillment_project-> get_id(); ?>">
        <div class="modal-body">
          <div class="form-group">
            <label>Names:</label>
            <input type="text" name="names" class="form-control form-control-sm" value="">
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
<!--*************************************edit real project cost**************************-->
<div class="modal fade" id="edit_real_project_cost_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="edit_real_project_cost_form" action="" method="post">

      </form>
    </div>
  </div>
</div>
<!--*************************************new document**************************-->
<div class="modal fade" id="new_document_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="new_document_form" action="" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id_fulfillment_project" value="<?php echo $fulfillment_project-> get_id(); ?>">
        <div class="modal-body">
          <div class="custom-file">
            <input type="file" class="custom-file-input" multiple name="files[]" id="customFile">
            <label class="custom-file-label" for="customFile" id="filenames">Choose file</label>
          </div>
          <div class="form-group">
            <label>Comment:</label>
            <textarea name="comment" class="form-control form-control-sm" rows="5"></textarea>
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
