<?php
class ProjectCommentRepository{
  public static function insert_comment($connection, $comment){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO project_comments(id_fulfillment_project, username, comment, comment_date) VALUES(:id_fulfillment_project, :username, :comment, NOW())';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $comment-> get_id_fulfillment_project(), PDO::PARAM_STR);
        $sentence-> bindParam(':username', $comment-> get_username(), PDO::PARAM_STR);
        $sentence-> bindParam(':comment', $comment-> get_comment(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_comments_by_project($connection, $id_fulfillment_project){
    $comments = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM project_comments WHERE id_fulfillment_project = :id_fulfillment_project ORDER BY comment_date DESC';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $comments[] = new ProjectComment($row['id'], $row['id_fulfillment_project'], $row['username'], $row['comment'], $row['comment_date']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $comments;
  }

  public static function count_all_comments_by_project($connection, $id_fulfillment_project){
    $comments = 0;
    if(isset($connection)){
      try{
        $sql = 'SELECT COUNT(*) as comments FROM project_comments WHERE id_fulfillment_project = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if($result['comments']){
          $comments = $result['comments'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $comments;
  }

  public static function print_all_comments_by_project($id_fulfillment_project){
    ConnectionFullFillment::open_connection();
    $fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
    $comments = self::get_all_comments_by_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
    ConnectionFullFillment::close_connection();
    ?>
    <ul class="timeline">
      <li class="clickable_title">
        <i class="fa fa-bookmark"></i>
        <div class="timeline-item">
          <h3 class="timeline-header">Proposal: <?php echo $fulfillment_project-> get_id(); ?></a></h3>
        </div>
      </li>
      <?php
      if(count($comments)){
        foreach ($comments as $comment) {
          $comment_date = RepositorioRfqFullFillmentComment::mysql_datetime_to_english_format($comment-> get_comment_date());
          ?>
          <li class="body_comments">
            <i class="fa fa-user"></i>
            <div class="timeline-item">
              <span class="time"><i class="far fa-clock"></i> <?php echo $comment_date; ?></span>
              <h3 class="timeline-header">
                <span class="text-primary">
                <?php
                echo $comment-> get_username();
                ?>
                </span>
                 said</h3>
              <div class="timeline-body">
                <?php echo nl2br($comment-> get_comment()); ?>
              </div>
            </div>
          </li>
          <?php
        }
      }
      ?>
      <li>
        <i class="fa fa-infinity"></i>
      </li>
      </ul>
      <br>
      <?php
  }
}
?>
