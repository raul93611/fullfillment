<?php
class AccountingServicePriceRepository{
  public static function print_accounting_services($id_fulfillment_project){
    Connection::open_connection();
    ConnectionFullFillment::open_connection();
    $fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
    $project = ProjectRepository::get_project_by_id(Connection::get_connection(), $fulfillment_project-> get_id_project());
    $services = ServiceRepository::get_services_by_id_project(Connection::get_connection(), $fulfillment_project-> get_id_project());
    $real_cost_by_project = self::get_real_cost_by_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
    $extra_services = ExtraServiceRepository::get_all_extra_services_by_id_fulfillment_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
    $total_extra_service = ExtraServiceRepository::get_total_extra_service_by_fulfillment_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
    ConnectionFullFillment::close_connection();
    Connection::close_connection();
    if(!count($extra_services)){
      $extra_services_quantity = 1;
    }else {
      $extra_services_quantity = count($extra_services);
    }
    if(count($services)){
      ?>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="thin">OPT</th>
              <th class="thin">#</th>
              <th class="description">PROJECT SPECIFICATIONS</th>
              <th>INVOICE</th>
              <th>COMPANY</th>
              <th class="thin">QTY</th>
              <th>UNIT COST</th>
              <th>OTHER COST</th>
              <th>REAL COST</th>
              <th>PROFIT</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($services as $i => $service) {
              self::print_accounting_service($service, $i);
            }
            ?>
            <tr>
              <td class="align-middle text-center" rowspan="<?php echo $extra_services_quantity; ?>">
                <button type="button" class="new_extra_service_button btn btn-warning" name="" data="<?php echo $id_fulfillment_project; ?>"><i class="fas fa-plus"></i></button>
              </td>
              <td rowspan="<?php echo $extra_services_quantity; ?>"></td>
              <td class="align-middle" colspan="2" rowspan="<?php echo $extra_services_quantity; ?>"><b>EXTRA COST:</b></td>
              <?php
              if(count($extra_services)){
                ?>
                <td colspan="4"><a href="#" data="<?php echo $extra_services[0]-> get_id(); ?>" class="edit_extra_service_button"><?php echo $extra_services[0]-> get_description(); ?></a></td>
                <td><?php echo $extra_services[0]-> get_cost(); ?></td>
                <td rowspan="<?php echo $extra_services_quantity; ?>"></td>
              </tr>
                <?php
                for ($o=1; $o < count($extra_services) ; $o++) {
                  $extra_service = $extra_services[$o];
                  ?>
                  <tr>
                    <td colspan="4"><a href="#" data="<?php echo $extra_service-> get_id(); ?>" class="edit_extra_service_button"><?php echo $extra_service-> get_description(); ?></a></td>
                    <td><?php echo $extra_service-> get_cost(); ?></td>
                  </tr>
                  <?php
                }
              }
              ?>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td><b>TOTAL:</b></td>
              <td><?php echo $project-> get_total_service(); ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><?php echo $real_cost_by_project + $total_extra_service; ?></td>
              <td><?php echo $project-> get_total_service() - ($real_cost_by_project + $total_extra_service); ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <?php
    }
  }

  public static function print_accounting_service($service, $i){
    if(!isset($service)){
      return;
    }
    ConnectionFullFillment::open_connection();
    $accounting_service_prices = self::get_all_accounting_service_prices_by_id_service(ConnectionFullFillment::get_connection(), $service-> get_id());
    $real_cost_by_service = self::get_real_cost_by_service(ConnectionFullFillment::get_connection(), $service-> get_id());
    ConnectionFullFillment::close_connection();
    if(!count($accounting_service_prices)){
      $quantity = 1;
    }else{
      $quantity = count($accounting_service_prices);
    }
    ?>
    <tr>
      <td class="align-middle text-center" rowspan="<?php echo $quantity; ?>">
        <button type="button" class="new_accounting_service_price_button btn btn-warning" name="<?php echo $service-> get_id(); ?>"><i class="fas fa-plus"></i></button>
      </td>
      <td rowspan="<?php echo $quantity; ?>"><?php echo $i + 1; ?></td>
      <td rowspan="<?php echo $quantity; ?>">
        <?php
        echo '<b>Description:</b> ' . nl2br(mb_substr($service-> get_description(), 0, 100));
        ?>
      </td>
      <td rowspan="<?php echo $quantity; ?>"><?php echo $service-> get_total(); ?></td>
      <?php
    if(count($accounting_service_prices)){
          ?>
          <td><a href="#" data="<?php echo $accounting_service_prices[0]-> get_id(); ?>" class="edit_accounting_service_price_button"><?php echo $accounting_service_prices[0]-> get_company(); ?></a></td>
          <td><?php echo $accounting_service_prices[0]-> get_quantity(); ?></td>
          <td><?php echo $accounting_service_prices[0]-> get_unit_cost(); ?></td>
          <td><?php echo $accounting_service_prices[0]-> get_other_cost(); ?></td>
          <td><?php echo $accounting_service_prices[0]-> get_real_cost(); ?></td>
          <td rowspan="<?php echo $quantity; ?>"><?php echo $service-> get_total() - $real_cost_by_service; ?></td>
      </tr>
      <?php
      for ($j = 1; $j < count($accounting_service_prices); $j++) {
        $accounting_service_price = $accounting_service_prices[$j];
        ?>
        <tr>
          <td><a href="#" data="<?php echo $accounting_service_price-> get_id(); ?>" class="edit_accounting_service_price_button"><?php echo $accounting_service_price-> get_company(); ?></a></td>
          <td><?php echo $accounting_service_price-> get_quantity(); ?></td>
          <td><?php echo $accounting_service_price-> get_unit_cost(); ?></td>
          <td><?php echo $accounting_service_price-> get_other_cost(); ?></td>
          <td><?php echo $accounting_service_price-> get_real_cost(); ?></td>
        </tr>
        <?php
      }
    }
  }

  public static function insert_accounting_service_price($connection, $accounting_service_price){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO accounting_services_price(id_service, company, quantity, unit_cost, other_cost, real_cost, id_fulfillment_project) VALUES(:id_service, :company, :quantity, :unit_cost, :other_cost, :real_cost, :id_fulfillment_project)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_service', $accounting_service_price-> get_id_service(), PDO::PARAM_STR);
        $sentence-> bindParam(':company', $accounting_service_price-> get_company(), PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $accounting_service_price-> get_quantity(), PDO::PARAM_STR);
        $sentence-> bindParam(':unit_cost', $accounting_service_price-> get_unit_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':other_cost', $accounting_service_price-> get_other_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':real_cost', $accounting_service_price-> get_real_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':id_fulfillment_project', $accounting_service_price-> get_id_fulfillment_project(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_accounting_service_prices_by_id_service($connection, $id_service){
    $services = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM accounting_services_price WHERE id_service = :id_service';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_service', $id_service, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $services[] = new AccountingServicePrice($row['id'], $row['id_service'], $row['company'], $row['quantity'], $row['unit_cost'], $row['other_cost'], $row['real_cost'], $row['id_fulfillment_project']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $services;
  }

  public static function get_accounting_service_price_by_id($connection, $id_accounting_service_price){
    $service = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM accounting_services_price WHERE id = :id_accounting_service_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_accounting_service_price', $id_accounting_service_price, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $service = new AccountingServicePrice($result['id'], $result['id_service'], $result['company'], $result['quantity'], $result['unit_cost'], $result['other_cost'], $result['real_cost'], $result['id_fulfillment_project']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $service;
  }

  public static function update_accounting_service_price($connection, $company, $quantity, $unit_cost, $other_cost, $real_cost, $id_accounting_service_price){
    if(isset($connection)){
      try{
        $sql = 'UPDATE accounting_services_price SET company = :company, quantity = :quantity, unit_cost = :unit_cost, other_cost = :other_cost, real_cost = :real_cost WHERE id = :id_accounting_service_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':company', $company, PDO::PARAM_STR);
        $sentence-> bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $sentence-> bindParam(':unit_cost', $unit_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':other_cost', $other_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':real_cost', $real_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':id_accounting_service_price', $id_accounting_service_price, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function remove_accounting_service_price($connection, $id_accounting_service_price){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM accounting_services_price WHERE id = :id_accounting_service_price';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_accounting_service_price', $id_accounting_service_price, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_real_cost_by_service($connection, $id_service){
    if(isset($connection)){
      try{
        $sql = 'SELECT SUM(real_cost) as real_cost FROM accounting_services_price WHERE id_service = :id_service';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_service', $id_service, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result['real_cost'])){
          $real_cost = $result['real_cost'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $real_cost;
  }

  public static function get_real_cost_by_project($connection, $id_fulfillment_project){
    if(isset($connection)){
      try{
        $sql = 'SELECT (SUM(real_cost)) as real_cost FROM accounting_services_price WHERE id_fulfillment_project = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result['real_cost'])){
          $real_cost = $result['real_cost'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $real_cost;
  }
}
?>
