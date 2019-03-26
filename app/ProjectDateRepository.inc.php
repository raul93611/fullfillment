<?php
class ProjectDateRepository{
  public static function insert_date($connection, $date){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO project_dates(id_fulfillment_project, date, comment) VALUES(:id_fulfillment_project, :date, :comment)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $date-> get_id_fulfillment_project(), PDO::PARAM_STR);
        $sentence-> bindParam(':date', $date-> get_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':comment', $date-> get_comment(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_dates_by_project($connection, $id_fulfillment_project){
    if(isset($connection)){
      try{
        $sql = 'SELECT id, SUBSTRING(comment,1,20) as title, date as start FROM project_dates WHERE id_fulfillment_project = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $result;
  }

  public static function get_date_by_id($connection, $id_project_date){
    $date = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM project_dates WHERE id = :id_project_date';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_project_date', $id_project_date, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $date = new ProjectDate($result['id'], $result['id_fulfillment_project'], $result['date'], $result['comment']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $date;
  }

  public static function remove_date($connection, $id_project_date){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM project_dates WHERE id = :id_project_date';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_project_date', $id_project_date, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_recent_dates($connection){
    $dates = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM project_dates WHERE date >= NOW() ORDER BY date';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $dates[] = new ProjectDate($row['id'], $row['id_fulfillment_project'], $row['date'], $row['comment']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $dates;
  }

  public static function print_all_project_dates(){
    ConnectionFullFillment::open_connection();
    $dates = self::get_all_recent_dates(ConnectionFullFillment::get_connection());
    if(count($dates)){
      foreach ($dates as $key => $date) {
        $project_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($date-> get_date());
        $fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id(ConnectionFullFillment::get_connection(), $date-> get_id_fulfillment_project());
        Connection::open_connection();
        $project = ProjectRepository::get_project_by_id(Connection::get_connection(), $fulfillment_project-> get_id_project());
        Connection::close_connection();
        ?>
        <div class="card card-primary">
          <div class="card-header">
            <span>Project: <?php echo $project-> get_project_name(); ?></span>
            <span class="float-right"><?php echo $project_date; ?></span>
          </div>
          <div class="card-body">
            <p><?php echo nl2br($date-> get_comment()); ?></p>
          </div>
        </div>
        <?php
      }
    }
    ConnectionFullFillment::close_connection();
  }
}
?>
