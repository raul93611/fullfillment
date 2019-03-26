<?php
class FulfillmentProjectRepository{
  public static function insert_fulfillment_project($connection, $fulfillment_project){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO fulfillment_projects(id_project, received, received_date) VALUES(:id_project, :received, NOW())';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_project', $fulfillment_project-> get_id_project(), PDO::PARAM_STR);
        $sentence-> bindParam(':received', $fulfillment_project-> get_received(), PDO::PARAM_STR);
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
        $sql = 'SELECT id_project, received_date, DATEDIFF(CURDATE(), received_date) as info FROM fulfillment_projects WHERE received = 1';
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
          <th>INFO</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(count($projects)){
          foreach ($projects as $key => $project) {
            self::print_received_project($project);
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
          <a href="<?php echo EDIT_PROJECT . $project['id_project']; ?>">
            <?php echo $project['id_project']; ?>
          </a>
        </td>
        <td><?php echo $project['received_date']; ?></td>
        <td class="text-danger font-weight-bold"><?php echo $project['info']; ?> days</td>
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
          $project = new FulfillmentProject($result['id'], $result['id_project'], $result['received'], $result['received_date']);
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
          $project = new FulfillmentProject($result['id'], $result['id_project'], $result['received'], $result['received_date']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $project;
  }
}
?>
