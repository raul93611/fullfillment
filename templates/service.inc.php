<?php
Connection::open_connection();
$service = ServiceRepository::get_service_by_id(Connection::get_connection(), $id_service);
$project = ProjectRepository::get_project_by_id(Connection::get_connection(), $service-> get_id_project());
Connection::close_connection();
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-3">
          <h1>Service</h1>
        </div>
        <div class="col-sm-3">
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
              <h3 class="card-title"><i class="fas fa-user-tie"></i> Staff</h3>
            </div>
            <div class="card-body">
              <?php
              if($project-> get_submission_instructions() == 'gsa'){
                $gsa = '1';
              }else{
                $gsa = '0';
              }
              Connection::open_connection();
              $total_staff = StaffRepository::show_staff($service-> get_id(), $gsa);
              Connection::close_connection();
              ?>
            </div>
          </div>
          <div class="card card-primary" id="costs">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-money-bill-wave"></i> Costs</h3>
            </div>
            <div class="card-body">
              <?php
              CostRepository::show_costs($service-> get_id());
              ?>
            </div>
          </div>
          <br>
          <div class="container">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-money-bill-wave"></i> Total</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 text-center">
                    <h4>TOTAL:</h4>
                  </div>
                  <div class="col-md-6 text-center">
                    <h4>$ <?php echo $service-> get_total(); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer footer">
            <a class="btn btn-primary" id="go_back" href="<?php echo EDIT_PROJECT . $project-> get_id(); ?>"><i class="fa fa-reply"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
