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
}
?>
