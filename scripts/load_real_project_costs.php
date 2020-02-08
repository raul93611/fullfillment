<?php
session_start();
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
Connection::open_connection();
$fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
$project = ProjectRepository::get_project_by_id(Connection::get_connection(), $fulfillment_project-> get_id_project());
$real_project_costs = RealProjectExtracostRepository::get_all_costs_by_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
$total_real_project_cost = RealProjectExtracostRepository::get_total_cost(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
Connection::close_connection();
ConnectionFullFillment::close_connection();
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
