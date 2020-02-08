<?php
class ExtraServiceRepository{
  public static function insert_extra_service($connection, $extra_service){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO extra_services(id_fulfillment_project, description, cost) VALUES(:id_fulfillment_project, :description, :cost)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $extra_service-> get_id_fulfillment_project(), PDO::PARAM_STR);
        $sentence-> bindParam(':description', $extra_service-> get_description(), PDO::PARAM_STR);
        $sentence-> bindParam(':cost', $extra_service-> get_cost(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function update_extra_service($connection, $description, $cost, $id_extra_service){
    if(isset($connection)){
      try{
        $sql = 'UPDATE extra_services SET description = :description, cost = :cost WHERE id = :id_extra_service';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':description', $description, PDO::PARAM_STR);
        $sentence-> bindParam(':cost', $cost, PDO::PARAM_STR);
        $sentence-> bindParam(':id_extra_service', $id_extra_service, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function remove_extra_service($connection, $id_extra_service){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM extra_services WHERE id = :id_extra_service';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_extra_service', $id_extra_service, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_extra_services_by_id_fulfillment_project($connection, $id_fulfillment_project){
    $extra_services = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM extra_services WHERE id_fulfillment_project = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $extra_services[] = new ExtraService($row['id'], $row['id_fulfillment_project'], $row['description'], $row['cost']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $extra_services;
  }

  public static function get_extra_service_by_id($connection, $id_extra_service){
    $extra_service = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM extra_services WHERE id = :id_extra_service';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_extra_service', $id_extra_service, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $extra_service = new ExtraService($result['id'], $result['id_fulfillment_project'], $result['description'], $result['cost']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $extra_service;
  }

  public static function get_total_extra_service_by_fulfillment_project($connection, $id_fulfillment_project){
    if(isset($connection)){
      try{
        $sql = 'SELECT SUM(cost) as total FROM extra_services WHERE id_fulfillment_project = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
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
