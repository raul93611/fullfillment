<?php
class ShipToRepository{
  public static function insert_ship_to($connection, $ship_to){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO ship_to(ship_to) VALUES(:ship_to)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':ship_to', $ship_to-> get_ship_to(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
  }

  public static function get_all_ship_to($connection){
    $ship_to = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM ship_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $ship_to[] = new ShipTo($row['id'], $row['ship_to']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
    return $ship_to;
  }
}
?>
