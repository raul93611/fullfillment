<?php
class RepositorioProviderSubitemFullFillment{
  public static function insertar_provider_subitem($conexion, $provider_subitem){
    if(isset($conexion)){
      try{
        $sql = 'INSERT INTO provider_subitems(id_subitem, provider, price) VALUES(:id_subitem, :provider, :price)';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':id_subitem', $provider_subitem-> obtener_id_subitem(), PDO::PARAM_STR);
        $sentencia-> bindParam(':provider', $provider_subitem-> obtener_provider(), PDO::PARAM_STR);
        $sentencia-> bindParam(':price', $provider_subitem-> obtener_price(), PDO::PARAM_STR);
        $sentencia-> execute();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
