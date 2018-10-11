<?php
class RepositorioItemFullFillment{
  public static function insertar_item($conexion, $item) {
    $item_insertado = false;
    if (isset($conexion)) {
      try {
        $sql = 'INSERT INTO item(id_rfq, id_usuario, provider_menor, brand, brand_project, part_number, part_number_project, description, description_project, quantity, unit_price, total_price, comments, website, additional) VALUES(:id_rfq, :id_usuario, :provider_menor, :brand, :brand_project, :part_number, :part_number_project, :description, :description_project, :quantity, :unit_price, :total_price, :comments, :website, :additional)';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_rfq', $item->obtener_id_rfq(), PDO::PARAM_STR);
        $sentencia->bindParam(':id_usuario', $item->obtener_id_usuario(), PDO::PARAM_STR);
        $sentencia->bindParam(':provider_menor', $item->obtener_provider_menor(), PDO::PARAM_STR);
        $sentencia->bindParam(':brand', $item->obtener_brand(), PDO::PARAM_STR);
        $sentencia->bindParam(':brand_project', $item->obtener_brand_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':part_number', $item->obtener_part_number(), PDO::PARAM_STR);
        $sentencia->bindParam(':part_number_project', $item->obtener_part_number_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':description', $item->obtener_description(), PDO::PARAM_STR);
        $sentencia->bindParam(':description_project', $item->obtener_description_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':quantity', $item->obtener_quantity(), PDO::PARAM_STR);
        $sentencia->bindParam(':unit_price', $item->obtener_unit_price(), PDO::PARAM_STR);
        $sentencia->bindParam(':total_price', $item->obtener_total_price(), PDO::PARAM_STR);
        $sentencia->bindParam(':comments', $item->obtener_comments(), PDO::PARAM_STR);
        $sentencia->bindParam(':website', $item->obtener_website(), PDO::PARAM_STR);
        $sentencia->bindParam(':additional', $item->obtener_additional(), PDO::PARAM_STR);
        $sentencia->execute();
        $id = $conexion->lastInsertId();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }
}
?>
