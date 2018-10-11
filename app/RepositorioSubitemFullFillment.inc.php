<?php
class RepositorioSubitemFullFillment{
  public static function insertar_subitem($conexion, $subitem) {
    if (isset($conexion)) {
      try {
        $sql = 'INSERT INTO subitems(id_item, provider_menor, brand, brand_project, part_number, part_number_project, description, description_project, quantity, unit_price, total_price, comments, website, additional) VALUES(:id_item, :provider_menor, :brand, :brand_project, :part_number, :part_number_project, :description, :description_project, :quantity, :unit_price, :total_price, :comments, :website, :additional)';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_item', $subitem->obtener_id_item(), PDO::PARAM_STR);
        $sentencia->bindParam(':provider_menor', $subitem->obtener_provider_menor(), PDO::PARAM_STR);
        $sentencia->bindParam(':brand', $subitem->obtener_brand(), PDO::PARAM_STR);
        $sentencia->bindParam(':brand_project', $subitem->obtener_brand_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':part_number', $subitem->obtener_part_number(), PDO::PARAM_STR);
        $sentencia->bindParam(':part_number_project', $subitem->obtener_part_number_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':description', $subitem->obtener_description(), PDO::PARAM_STR);
        $sentencia->bindParam(':description_project', $subitem->obtener_description_project(), PDO::PARAM_STR);
        $sentencia->bindParam(':quantity', $subitem->obtener_quantity(), PDO::PARAM_STR);
        $sentencia->bindParam(':unit_price', $subitem->obtener_unit_price(), PDO::PARAM_STR);
        $sentencia->bindParam(':total_price', $subitem->obtener_total_price(), PDO::PARAM_STR);
        $sentencia->bindParam(':comments', $subitem->obtener_comments(), PDO::PARAM_STR);
        $sentencia->bindParam(':website', $subitem->obtener_website(), PDO::PARAM_STR);
        $sentencia->bindParam(':additional', $subitem->obtener_additional(), PDO::PARAM_STR);
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
