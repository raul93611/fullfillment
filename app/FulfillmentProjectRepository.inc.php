<?php
class FulfillmentProjectRepository{
  public static function insert_fulfillment_project($connection, $fulfillment_project){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO fulfillment_projects(id_project, received, received_date, name, business_classification, due_date, ship_to, accounting_completed, accounting_completed_date, order_date) VALUES(:id_project, :received, NOW(), :name, :business_classification, :due_date, :ship_to, :accounting_completed, :accounting_completed_date, :order_date)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_project', $fulfillment_project-> get_id_project(), PDO::PARAM_STR);
        $sentence-> bindParam(':received', $fulfillment_project-> get_received(), PDO::PARAM_STR);
        $sentence-> bindParam(':name', $fulfillment_project-> get_name(), PDO::PARAM_STR);
        $sentence-> bindParam(':business_classification', $fulfillment_project-> get_business_classification(), PDO::PARAM_STR);
        $sentence-> bindParam(':due_date', $fulfillment_project-> get_due_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':ship_to', $fulfillment_project-> get_ship_to(), PDO::PARAM_STR);
        $sentence-> bindParam(':accounting_completed', $fulfillment_project-> get_accounting_completed(), PDO::PARAM_STR);
        $sentence-> bindParam(':accounting_completed_date', $fulfillment_project-> get_accounting_completed_date(), PDO::PARAM_STR);
        $sentence-> execute();
        $id = $connection-> lastInsertId();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }

  public static function get_all_received_projects($connection){
    if(isset($connection)){
      try{
        $sql = 'SELECT id_project, received_date, accounting_completed FROM fulfillment_projects WHERE received = 1';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchall(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $result;
  }

  public static function print_received_projects_table(){
    ConnectionFullfillment::open_connection();
    $projects = self::get_all_received_projects(ConnectionFullfillment::get_connection());
    ConnectionFullfillment::close_connection();
    ?>
    <table class="rfp_team_table table table-bordered">
      <thead>
        <tr>
          <th>PROPOSAL</th>
          <th>RECEIVED DATE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(count($projects)){
          foreach ($projects as $key => $project) {
            if(!$project['accounting_completed']){
              self::print_received_project($project);
            }
          }
        }
        ?>
      </tbody>
    </table>
    <?php
  }

  public static function print_received_project($project){
    if(isset($project)){
      ?>
      <tr>
        <td>
          <?php
          if($_SESSION['level'] == 3){
            ?>
            <a href="<?php echo EDIT_ACCOUNTING_PROJECT . $project['id_project']; ?>">
              <?php echo $project['id_project']; ?>
            </a>
            <?php
          }else{
            ?>
            <a href="<?php echo EDIT_PROJECT . $project['id_project']; ?>">
              <?php echo $project['id_project']; ?>
            </a>
            <?php
          }
          ?>
        </td>
        <td><?php echo $project['received_date']; ?></td>
      </tr>
      <?php
    }
  }

  public static function get_fulfillment_project_by_id_project($connection, $id_project){
    $project = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM fulfillment_projects WHERE id_project = :id_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_project', $id_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $project = new FulfillmentProject($result['id'], $result['id_project'], $result['received'], $result['received_date'], $result['name'], $result['business_classification'], $result['due_date'], $result['ship_to'], $result['accounting_completed'], $result['accounting_completed_date'], $result['order_date']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $project;
  }

  public static function get_fulfillment_project_by_id($connection, $id_fulfillment_project){
    $project = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM fulfillment_projects WHERE id = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $project = new FulfillmentProject($result['id'], $result['id_project'], $result['received'], $result['received_date'], $result['name'], $result['business_classification'], $result['due_date'], $result['ship_to'], $result['accounting_completed'], $result['accounting_completed_date'], $result['order_date']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $project;
  }

  public static function get_all_completed_projects($connection){
    if(isset($connection)){
      try{
        $sql = 'SELECT id_project as proposal, accounting_completed_date FROM fulfillment_projects WHERE accounting_completed = 1';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchall(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $result;
  }

  public static function save_accounting_project($connection, $name, $order_date, $due_date, $ship_to, $business_classification, $id_fulfillment_project){
    if(isset($connection)){
      try{
        $sql = 'UPDATE fulfillment_projects SET name = :name, order_date = :order_date, due_date = :due_date, ship_to = :ship_to, business_classification = :business_classification WHERE id = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':name', $name, PDO::PARAM_STR);
        $sentence-> bindParam(':order_date', $order_date, PDO::PARAM_STR);
        $sentence-> bindParam(':due_date', $due_date, PDO::PARAM_STR);
        $sentence-> bindParam(':ship_to', $ship_to, PDO::PARAM_STR);
        $sentence-> bindParam(':business_classification', $business_classification, PDO::PARAM_STR);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function print_accounting_completed($project){
    if(!isset($project)){
      return;
    }
    $date = RepositorioRfqFullFillmentComment::mysql_datetime_to_english_format($project['accounting_completed_date']);
    ?>
    <tr>
      <td>
        <a href="<?php echo EDIT_ACCOUNTING_PROJECT . $project['proposal']; ?>" class="btn-block">
          <?php echo $project['proposal']; ?>
        </a>
      </td>
      <td><?php echo $date; ?></td>
    </tr>
    <?php
  }

  public static function print_accounting_completed_table(){
    ConnectionFullFillment::open_connection();
    $projects = self::get_all_completed_projects(ConnectionFullFillment::get_connection());
    ConnectionFullFillment::close_connection();
    ?>
    <table class="rfp_team_table table table-bordered">
      <thead>
        <tr>
          <th>PROPOSAL</th>
          <th>ACCOUNTING DATE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(count($projects)){
          foreach ($projects as $project) {
            self::print_accounting_completed($project);
          }
        }
        ?>
      </tbody>
    </table>
    <?php
  }

  public static function set_accounting_completed($connection, $id_fulfillment_project){
    if(isset($connection)){
      try{
        $sql = 'UPDATE fulfillment_projects SET accounting_completed = 1, accounting_completed_date = NOW() WHERE id = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
