<?php
class RepositorioFullFillmentComment{
  public static function insertar_comment($conexion, $comment){
    if(isset($conexion)){
      try{
        $sql = 'INSERT INTO comments (id_rfq, id_usuario, comment, fecha_comment) VALUES(:id_rfq, :id_usuario, :comment, NOW())';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':id_rfq', $comment-> obtener_id_rfq(), PDO::PARAM_STR);
        $sentencia-> bindParam(':id_usuario', $comment-> obtener_id_usuario(), PDO::PARAM_STR);
        $sentencia-> bindParam(':comment', $comment-> obtener_comment(), PDO::PARAM_STR);
        $sentencia-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
