<form method="post" id="edit_project_forms" action="">
  <input type="hidden" name="id_project" id="id_project" value="<?php echo $id_project; ?>">
  <input type="hidden" id="id_fulfillment_project" value="<?php echo $fulfillment_project-> get_id(); ?>">
  <?php
  if(!$project-> get_previous_contract()){
    ?>
    <div id="calendar"></div>
    <?php
  }
  ?>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-list-alt"></i> Main information</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group row">
            <?php
            Connection::open_connection();
            $user = UserRepository::get_user_by_id(Connection::get_connection(), $project-> get_designated_user());
            Connection::close_connection();
            ?>
            <label class="col-sm-2 col-form-label col-form-label-sm">Designated user:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" disabled value="<?php echo $user-> get_username(); ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Code:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" disabled value="<?php echo $project-> get_code(); ?>" placeholder="Code ...">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Name:</label>
            <div class="col-sm-10">
              <input class="form-control form-control-sm" type="text" disabled value="<?php echo $project-> get_project_name(); ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Business type:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" disabled value="<?php echo $project-> get_business_type(); ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Priority:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" disabled value="<?php echo $project-> get_priority(); ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Submission instructions:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" disabled value="<?php echo $project-> get_submission_instructions(); ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Type:</label>
            <div class="col-sm-10">
              <input class="form-control form-control-sm" disabled value="<?php if($project-> get_type() == 'services_and_equipment'){echo 'Services and equipment';}else{echo 'Services';} ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Subject:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" disabled value="<?php echo $project-> get_subject(); ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Address:</label>
            <div class="col-sm-10">
              <textarea class="form-control form-control-sm" disabled rows="5"><?php echo $project-> get_address(); ?></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Ship to:</label>
            <div class="col-sm-10">
              <textarea class="form-control form-control-sm" disabled rows="5"><?php echo $project-> get_ship_to(); ?></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-sm">Description:</label>
            <div class="col-sm-10">
              <textarea class="form-control form-control-sm" disabled rows="5"><?php echo $project-> get_description(); ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label>Documents:</label>
            <?php
            $directory = $_SERVER['DOCUMENT_ROOT'] . '/rfp/documents/' . $id_project;
            if (is_dir($directory)) {
              $manager = opendir($directory);
              $folder = @scandir($directory);
              if(count($folder) <= 2){
              }
              $files = [];
              while (($file = readdir($manager)) !== false) {
                $complete_directory = $directory . "/" . $file;
                if ($file != "." && $file != "..") {
                  $files[] = $file;
                }
              }
              $files = implode(',', $files);
              ?>
              <input type="hidden" id="files" value="<?php echo $files; ?>">
              <?php
              closedir($manager);
            }
            if(!empty($files)){
              ?>
              <input type="file" id="file_input_rfp" multiple name="file_input[]">
              <?php
            }else {
              ?>
              <h3 class="text-center text-danger"><i class="fas fa-exclamation-triangle"></i> No documents!</h3>
              <?php
            }
            ?>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  if(!$project-> get_previous_contract()){
    ?>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-project-diagram"></i> Previous contracts</h3>
      </div>
      <div class="card-body">
        <div class="list-group">
          <?php
          if(count($previous_contracts)){
            foreach ($previous_contracts as $i => $previous_contract) {
              ConnectionFullFillment::open_connection();
              $fulfillment_project_previous_contract = FulfillmentProjectRepository::get_fulfillment_project_by_id_project(ConnectionFullFillment::get_connection(), $previous_contract-> get_id());
              ConnectionFullFillment::close_connection();
              if(is_null($fulfillment_project_previous_contract)){
                ?>
                <li class="list-group-item" >Previous contract: <?php echo $previous_contract-> get_id(); ?><span class="float-right text-danger">Not ready!</span></li>
                <?php
              }else{
                ?>
                <a class="list-group-item list-group-item-action" href="<?php echo EDIT_PROJECT . $previous_contract-> get_id(); ?>">Previous contract: <?php echo $previous_contract-> get_id(); ?></a>
                <?php
              }
            }
          }else{
            ?>
            <h3 class="text-center text-danger"><i class="fa fa-times"></i> No previous contracts!</h3>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <?php
  }
  ?>
  <div class="card card-primary total">
    <div class="card-header">
      <h3 class="d-inline card-title"><i class="fas fa-list-alt"></i> Total</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <?php
          if(count($services)){
            ?>
            <div class="list-group">
              <?php
              foreach ($services as $i => $service) {
                $a = $i + 1;
                ?>
                <a href="<?php echo SERVICE . $service-> get_id(); ?>" class="text-primary list-group-item list-group-item-action font-weight-bold">Year <?php echo $a; ?>:<span class="text-dark">$ <?php echo number_format($service-> get_total(), 2); ?></span></a>
                <?php
              }
              ?>
              <li class="list-group-item text-primary font-weight-bold">TOTAL SERVICE: <span class="text-dark">$ <?php echo $project-> get_total_service(); ?></span></li>
              <?php
              if($project-> get_type() == 'services_and_equipment'){
                ?>
                <li class="list-group-item text-primary font-weight-bold">TOTAL EQUIPMENT: <span class="text-dark">$ <?php echo $project-> get_total_equipment(); ?></span></li>
                <li class="list-group-item text-primary font-weight-bold" id="total_project" data="<?php echo $total_project = $project-> get_total_service() + $project-> get_total_equipment(); ?>">TOTAL: <span class="text-dark">$ <?php echo $project-> get_total_service() + $project-> get_total_equipment(); ?></span></li>
                <?php
              }else{
                ?>
                <li class="list-group-item text-primary font-weight-bold" id="total_project" data="<?php echo $total_project = $project-> get_total_service(); ?>">TOTAL: <span class="text-dark">$ <?php echo $project-> get_total_service(); ?></span></li>
                <?php
              }
              ?>
            </div>
            <?php
          }else {
            ?>
            <h3 class="text-center text-default"><i class="fa fa-exclamation-triangle"></i> Not yet filled out</h3>
            <?php
          }
          ?>
        </div>
        <div class="col-md-6">
          <div id="real_project_costs">
            <?php
            if(count($real_project_costs)){
              ?>
              <div class="list-group">
              <?php
              foreach ($real_project_costs as $key => $real_project_cost) {
                ?>
                <a href="#" data="<?php echo $real_project_cost-> get_id(); ?>" class="edit_real_project_cost_button list-group-item list-group-item-action font-weight-bold text-primary">Year <?php echo $key+1; ?>:<span class="float-right text-dark">$ <?php echo $real_project_cost-> get_cost(); ?></span></a>
                <?php
              }
              ?>
              <li class="list-group-item text-primary font-weight-bold">TOTAL SERVICE: <span class="text-dark">$ <?php echo $total_real_project_cost; ?></span></li>
              <?php
              if($project-> get_type() == 'services_and_equipment'){
                ConnectionFullFillment::open_connection();
                $quote = RepositorioRfqFullFillment::get_quote_by_rfp(ConnectionFullFillment::get_connection(), $project-> get_id());
                ConnectionFullFillment::close_connection();
                ?>
                <li class="list-group-item text-primary font-weight-bold">TOTAL EQUIPMENT: <span class="text-dark">$ <?php echo $quote-> obtener_total_cost(); ?></span></li>
                <li class="list-group-item text-primary font-weight-bold" id="total_real_project" data="<?php echo $total_real_project = $total_real_project_cost + $quote-> obtener_total_cost(); ?>">TOTAL: <span class="text-dark">$ <?php echo $total_real_project_cost + $quote-> obtener_total_cost(); ?></span></li>
                <?php
              }else{
                ?>
                <li class="list-group-item text-primary font-weight-bold" id="total_real_project" data="<?php echo $total_real_project = $total_real_project_cost; ?>">TOTAL: <span class="text-dark">$ <?php echo $total_real_project_cost; ?></span></li>
                <?php
              }
              ?>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row my-4 justify-content-center">
        <div class="col-md-6" id="total_difference">
          <h2>TOTAL:<span class="float-right">$ <?php echo $total_project - $total_real_project ?></span></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-users"></i> Members</h3>
    </div>
    <div class="card-body">
      <button type="button" id="new_member_button" class="btn btn-info float-right" name="button"><i class="fas fa-plus"></i> New</button>
      <div class="clearfix"></div>
      <div id="members" class="mt-3">
        <?php
        if(count($members)){
          ?>
          <div class="list-group">
            <?php
            foreach ($members as $key => $member) {
              ?>
              <a href="#" data="<?php echo $member-> get_id(); ?>" class="edit_member_button list-group-item list-group-item-action"><?php echo $member-> get_names(); ?></a>
              <?php
            }
            ?>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-file"></i> Documents</h3>
    </div>
    <div class="card-body">
      <button type="button" class="btn btn-info float-right" id="new_document_button" name="button"><i class="fas fa-plus"></i> New document</button>
      <div class="clearfix"></div>
      <div class="row mt-3 project_documents">
        <div class="col-md-12">
          <?php
          ConnectionFullFillment::open_connection();
          $project_documents = ProjectDocumentRepository::get_all_project_documents_by_project(ConnectionFullFillment::get_connection(), $fulfillment_project-> get_id());
          ConnectionFullFillment::close_connection();
          ?>
          <div class="list-group">
            <?php
            if(count($project_documents)){
              foreach ($project_documents as $key => $project_document) {
                $document_date = RepositorioRfqFullFillmentComment::mysql_datetime_to_english_format($project_document-> get_document_date());
                ?>
                <li href="#" class="list-group-item list-group-item-action list-group-flush flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 text-primary font-weight-bold">Comment</h5>
                    <small><?php echo $document_date; ?></small>
                  </div>
                  <p class="mb-1"><?php echo nl2br($project_document-> get_comment()); ?></p>
                  <small class="text-primary"><?php echo $project_document-> get_username(); ?></small>
                  <h5 class="text-primary font-weight-bold">Documents</h5>
                  <?php
                  $documents_name = explode(',', $project_document-> get_documents_name());
                  foreach ($documents_name as $key => $document_name) {
                    ?>
                    <a href="<?php echo SERVER . 'documents/rfp_team/' . $id_project . '/' . $document_name; ?>" download class="d-block"><i class="fas fa-file"></i> <?php echo $document_name; ?></a>
                    <?php
                  }
                  ?>
                </li>
                <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<div class="card-footer footer" id="footer_lg">
  <a class="btn btn-primary" id="go_back" href="<?php echo RECEIVED_PROJECTS; ?>"><i class="fa fa-reply"></i></a>
  <a href="#" id="new_project_comment_button" class="btn btn-success"><i class="fas fa-plus"></i> New comment</a>
</div>
