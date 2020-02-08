<?php
class RealProjectExtracostRepository{
  public static function insert_cost($connection, $cost){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO real_project_costs(id_fulfillment_project, description, cost) VALUES(:id_fulfillment_project, :description, :cost)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $cost-> get_id_fulfillment_project(), PDO::PARAM_STR);
        $sentence-> bindParam(':description', $cost-> get_description(), PDO::PARAM_STR);
        $sentence-> bindParam(':cost', $cost-> get_cost(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_costs_by_project($connection, $id_fulfillment_project){
    $costs = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM real_project_costs WHERE id_fulfillment_project = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $costs[] = new RealProjectExtracost($row['id'], $row['id_fulfillment_project'], $row['description'], $row['cost']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $costs;
  }

  public static function get_cost_by_id($connection, $id_real_project_cost){
    $cost = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM real_project_costs WHERE id = :id_real_project_cost';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_real_project_cost', $id_real_project_cost, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $cost = new RealProjectExtracost($result['id'], $result['id_fulfillment_project'], $result['description'], $result['cost']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $cost;
  }

  public static function update_cost($connection, $cost, $id_real_project_cost){
    if(isset($connection)){
      try{
        $sql = 'UPDATE real_project_costs SET cost = :cost WHERE id = :id_real_project_cost';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':cost', $cost, PDO::PARAM_STR);
        $sentence-> bindParam(':id_real_project_cost', $id_real_project_cost, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_total_cost($connection, $id_fulfillment_project){
    $total = 0;
    if(isset($connection)){
      try{
        $sql = 'SELECT SUM(cost) as total FROM real_project_costs WHERE id_fulfillment_project = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result['total'])){
          $total = $result['total'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $total;
  }

  public static function remove_cost($connection, $id_real_project_cost){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM real_project_costs WHERE id = :id_real_project_cost';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_real_project_cost', $id_real_project_cost, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
