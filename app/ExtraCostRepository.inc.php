<?php
class ExtraCostRepository{
  public static function insert_extra_cost($connection, $extra_cost){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO extra_costs(id_rfq, description, cost) VALUES(:id_rfq, :description, :cost)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $extra_cost-> get_id_rfq(), PDO::PARAM_STR);
        $sentence-> bindParam(':description', $extra_cost-> get_description(), PDO::PARAM_STR);
        $sentence-> bindParam(':cost', $extra_cost-> get_cost(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function update_extra_cost($connection, $description, $cost, $id_extra_cost){
    if(isset($connection)){
      try{
        $sql = 'UPDATE extra_costs SET description = :description, cost = :cost WHERE id = :id_extra_cost';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':description', $description, PDO::PARAM_STR);
        $sentence-> bindParam(':cost', $cost, PDO::PARAM_STR);
        $sentence-> bindParam(':id_extra_cost', $id_extra_cost, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function remove_extra_cost($connection, $id_extra_cost){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM extra_costs WHERE id = :id_extra_cost';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_extra_cost', $id_extra_cost, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_extra_costs_by_id_rfq($connection, $id_rfq){
    $extra_costs = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM extra_costs WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $extra_costs[] = new ExtraCost($row['id'], $row['id_rfq'], $row['description'], $row['cost']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $extra_costs;
  }

  public static function get_extra_cost_by_id($connection, $id_extra_cost){
    $extra_cost = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM extra_costs WHERE id = :id_extra_cost';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_extra_cost', $id_extra_cost, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $extra_cost = new ExtraCost($result['id'], $result['id_rfq'], $result['description'], $result['cost']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $extra_cost;
  }

  public static function get_total_extra_cost_by_quote($connection, $id_rfq){
    if(isset($connection)){
      try{
        $sql = 'SELECT SUM(cost) as total FROM extra_costs WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if($result['total']){
          $total = $result['total'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $total;
  }
}
?>
