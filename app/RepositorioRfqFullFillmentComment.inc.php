<?php
class RepositorioRfqFullFillmentComment{
  public static function insertar_comment($conexion, $comment){
    if(isset($conexion)){
      try{
        $sql = 'INSERT INTO comments_rfq (id_rfq, nombre_usuario, comment, fecha_comment) VALUES(:id_rfq, :nombre_usuario, :comment, NOW())';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':id_rfq', $comment-> obtener_id_rfq(), PDO::PARAM_STR);
        $sentencia-> bindParam(':nombre_usuario', $comment-> obtener_nombre_usuario(), PDO::PARAM_STR);
        $sentencia-> bindParam(':comment', $comment-> obtener_comment(), PDO::PARAM_STR);
        $sentencia-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function contar_todos_comentarios_quote($conexion, $id_rfq){
    $todos_comentarios_quote = 0;
    if(isset($conexion)){
      try{
        $sql = 'SELECT COUNT(*) as todos_comentarios_quote FROM comments_rfq WHERE id_rfq = :id_rfq';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia-> execute();
        $resultado = $sentencia-> fetch(PDO::FETCH_ASSOC);
        if(!empty($resultado)){
          $todos_comentarios_quote = $resultado['todos_comentarios_quote'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $todos_comentarios_quote;
  }

  public static function obtener_comments_de_un_rfq($conexion, $id_rfq){
    $comments = [];
    if(isset($conexion)){
      try{
        $sql = 'SELECT * FROM comments_rfq WHERE id_rfq = :id_rfq ORDER BY fecha_comment DESC';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia-> execute();
        $resultado = $sentencia-> fetchAll(PDO::FETCH_ASSOC);
        if(count($resultado)){
          foreach ($resultado as $fila) {
            $comments[] = new CommentRfqFullFillment($fila['id'], $fila['id_rfq'], $fila['nombre_usuario'], $fila['comment'], $fila['fecha_comment']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $comments;
  }

  public static function escribir_comments($id_rfq){
    ConnectionFullFillment::open_connection();
    $cotizacion = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $id_rfq);
    $comments = self::obtener_comments_de_un_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
    ConnectionFullFillment::close_connection();
    ?>
    <ul class="timeline">
      <li class="clickable_title">
        <i class="fa fa-bookmark"></i>
        <div class="timeline-item">
          <h3 class="timeline-header">Proposal: <?php echo $cotizacion-> obtener_id(); ?></a></h3>
        </div>
      </li>
      <?php
      if(count($comments)){
        foreach ($comments as $comment) {
          $fecha_comment = self::mysql_datetime_to_english_format($comment-> obtener_fecha_comment());
          ?>
          <li class="body_comments">
            <i class="fa fa-user"></i>
            <div class="timeline-item">
              <span class="time"><i class="far fa-clock"></i> <?php echo $fecha_comment; ?></span>
              <h3 class="timeline-header">
                <span class="text-primary">
                <?php
                echo $comment-> obtener_nombre_usuario();
                ?>
                </span>
                 said</h3>
              <div class="timeline-body">
                <?php echo nl2br($comment-> obtener_comment()); ?>
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

  public static function mysql_date_to_english_format($mysql_date){
    $parts_mysql_date = explode('-', $mysql_date);
    $english_format = $parts_mysql_date[1] . '/' . $parts_mysql_date[2] . '/' . $parts_mysql_date[0];
    return $english_format;
  }

  public static function mysql_datetime_to_english_format($mysql_datetime){
    $parts_mysql_datetime = explode(' ', $mysql_datetime);
    $date = $parts_mysql_datetime[0];
    $time = $parts_mysql_datetime[1];
    $date = self::mysql_date_to_english_format($date);
    $english_format = $date . ' ' . $time;
    return $english_format;
  }

  public static function english_format_to_mysql_date($english_format){
    $parts_english_format = explode('/', $english_format);
    $mysql_date = $parts_english_format[2] . '-' . $parts_english_format[0] . '-' . $parts_english_format[1];
    $mysql_date = strtotime($mysql_date);
    $mysql_date = date('Y-m-d', $mysql_date);
    return $mysql_date;
  }

  public static function english_format_to_mysql_datetime($english_format){
    $parts_english_format = explode(' ', $english_format);
    $date = $parts_english_format[0];
    $time = $parts_english_format[1];
    $parts_date = explode('/', $date);
    $date = $parts_date[2] . '-' . $parts_date[0] . '-' . $parts_date[1];
    $mysql_datetime = $date . ' ' . $time;
    $mysql_datetime = strtotime($mysql_datetime);
    $mysql_datetime = date('Y-m-d H:i:s', $mysql_datetime);
    return $mysql_datetime;
  }
}
?>
