<form id="accounting_project_form" action="" method="post">
  <input type="hidden" name="id_project" value="<?php echo $project-> get_id(); ?>">
  <input type="hidden" name="id_fulfillment_project" value="<?php echo $fulfillment_project-> get_id(); ?>">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-info"></i> Info</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <?php
            Connection::open_connection();
            $designated_user = UserRepository::get_user_by_id(Connection::get_connection(), $project-> get_designated_user());
            Connection::close_connection();
            ?>
            <label>Designated user:</label>
            <input type="text" disabled class="form-control form-control-sm" value="<?php echo $designated_user-> get_username(); ?>">
          </div>
          <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control form-control-sm" name="name" value="<?php echo $fulfillment_project-> get_name(); ?>">
          </div>
          <div class="form-group">
            <label>Order date:</label>
            <input type="text" class="date form-control form-control-sm" name="order_date" value="<?php if($order_date != '00/00/0000'){echo $order_date;} ?>">
          </div>
          <div class="form-group">
            <label>Due date:</label>
            <input type="text" class="date form-control form-control-sm" name="due_date" value="<?php if($due_date != '00/00/0000'){echo $due_date;} ?>">
          </div>
          <div class="form-group">
            <label for="business_classification">Business classification:</label>
            <select class="form-control form-control-sm" name="business_classification">
              <option value="small_business" <?php if($fulfillment_project-> get_business_classification() == 'small_business'){echo 'selected';} ?>>Small business</option>
              <option value="8a" <?php if($fulfillment_project-> get_business_classification() == '8a'){echo 'selected';} ?>>8A</option>
              <option value="hubzone" <?php if($fulfillment_project-> get_business_classification() == 'hubzone'){echo 'selected';} ?>>HUBZONE</option>
              <option value="full_and_open" <?php if($fulfillment_project-> get_business_classification() == 'full_and_open'){echo 'selected';} ?>>Full and open</option>
              <option value="gsa" <?php if($fulfillment_project-> get_business_classification() == 'gsa'){echo 'selected';} ?>>GSA</option>
            </select>
          </div>
          <div class="form-group">
            <label>Ship to:</label>
            <select class="form-control form-control-sm" name="ship_to">
              <?php
              ConnectionFullFillment::open_connection();
              $ship_to = ShipToRepository::get_all_ship_to(ConnectionFullFillment::get_connection());
              ConnectionFullFillment::close_connection();
              if(count($ship_to)){
                foreach ($ship_to as $key => $single_ship_to) {
                  ?>
                  <option value="<?php echo $single_ship_to-> get_ship_to(); ?>" <?php if($fulfillment_project-> get_ship_to() == $single_ship_to-> get_ship_to()){echo 'selected';} ?>>
                    <?php echo $single_ship_to-> get_ship_to(); ?>
                  </option>
                  <?php
                }
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-success" name="save_accounting_project"><i class="fas fa-check"></i> Save</button>
    </div>
  </div>
</form>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-money-bill-wave"></i> Services</h3>
  </div>
  <div class="card-body" id="accounting_project_table">
    <?php
    AccountingServicePriceRepository::print_accounting_services($fulfillment_project-> get_id());
    ?>
  </div>
</div>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-file"></i> Documents</h3>
  </div>
  <div class="card-body">
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
    <?php
    if($fulfillment_project-> get_accounting_completed()){

    }else if($fulfillment_project-> get_received()){
      ?>
      <div class="custom-control custom-checkbox accounting_project_completed">
        <input type="checkbox" class="custom-control-input" id="accounting_project_completed" value="<?php echo $fulfillment_project-> get_id(); ?>">
        <label class="custom-control-label" for="accounting_project_completed">Completed</label>
      </div>
      <?php
    }
    ?>
  </div>
</div>
<div class="card-footer footer_item" id="footer_lg">
  <a class="btn btn-primary" id="go_back" href="<?php if($fulfillment_project-> get_accounting_completed()){echo ACCOUNTING_COMPLETED_PROJECTS;}else{echo RECEIVED_PROJECTS;} ?>"><i class="fa fa-reply"></i></a>
  <a href="#" id="new_project_comment_button" class="btn btn-success"><i class="fas fa-plus"></i> New comment</a>
</div>
