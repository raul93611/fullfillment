<?php
class RepositorioRfqFullfillment{
  public static function insertar_cotizacion_fullfillment($conexion, $cotizacion) {
    $cotizacion_insertada = false;
    if (isset($conexion)) {
      try {
        $sql = 'INSERT INTO rfq(id, id_usuario, usuario_designado, canal, email_code, type_of_bid, issue_date, end_date, status, completado, total_cost, total_price, comments, award, fecha_completado, fecha_submitted, fecha_award, payment_terms, address, ship_to, expiration_date, ship_via, taxes, profit, additional, shipping, shipping_cost, rfp, fullfillment) VALUES(:id, :id_usuario, :usuario_designado, :canal, :email_code, :type_of_bid, :issue_date, :end_date, :status, :completado, :total_cost, :total_price, :comments, :award, :fecha_completado, :fecha_submitted, :fecha_award, :payment_terms, :address, :ship_to, :expiration_date, :ship_via, :taxes, :profit, :additional, :shipping, :shipping_cost, :rfp, :fullfillment)';
        $sentencia = $conexion->prepare($sql);
        $sentencia-> bindParam(':id', $cotizacion-> obtener_id(), PDO::PARAM_STR);
        $sentencia-> bindParam(':id_usuario', $cotizacion->obtener_id_usuario(), PDO::PARAM_STR);
        $sentencia-> bindParam(':usuario_designado', $cotizacion->obtener_usuario_designado(), PDO::PARAM_STR);
        $sentencia-> bindParam(':canal', $cotizacion->obtener_canal(), PDO::PARAM_STR);
        $sentencia-> bindParam(':email_code', $cotizacion->obtener_email_code(), PDO::PARAM_STR);
        $sentencia-> bindParam(':type_of_bid', $cotizacion->obtener_type_of_bid(), PDO::PARAM_STR);
        $sentencia-> bindParam(':issue_date', $cotizacion->obtener_issue_date(), PDO::PARAM_STR);
        $sentencia-> bindParam(':end_date', $cotizacion->obtener_end_date(), PDO::PARAM_STR);
        $sentencia-> bindParam(':status', $cotizacion->obtener_status(), PDO::PARAM_STR);
        $sentencia-> bindParam(':completado', $cotizacion->obtener_completado(), PDO::PARAM_STR);
        $sentencia-> bindParam(':total_cost', $cotizacion->obtener_total_cost(), PDO::PARAM_STR);
        $sentencia-> bindParam(':total_price', $cotizacion->obtener_total_price(), PDO::PARAM_STR);
        $sentencia-> bindParam(':comments', $cotizacion->obtener_comments(), PDO::PARAM_STR);
        $sentencia-> bindParam(':award', $cotizacion->obtener_award(), PDO::PARAM_STR);
        $sentencia-> bindParam(':fecha_completado', $cotizacion->obtener_fecha_completado(), PDO::PARAM_STR);
        $sentencia-> bindParam(':fecha_submitted', $cotizacion->obtener_fecha_submitted(), PDO::PARAM_STR);
        $sentencia-> bindParam(':fecha_award', $cotizacion->obtener_fecha_award(), PDO::PARAM_STR);
        $sentencia-> bindParam(':payment_terms', $cotizacion->obtener_payment_terms(), PDO::PARAM_STR);
        $sentencia-> bindParam(':address', $cotizacion->obtener_address(), PDO::PARAM_STR);
        $sentencia-> bindParam(':ship_to', $cotizacion->obtener_ship_to(), PDO::PARAM_STR);
        $sentencia-> bindParam(':expiration_date', $cotizacion->obtener_expiration_date(), PDO::PARAM_STR);
        $sentencia-> bindParam(':ship_via', $cotizacion->obtener_ship_via(), PDO::PARAM_STR);
        $sentencia-> bindParam(':taxes', $cotizacion->obtener_taxes(), PDO::PARAM_STR);
        $sentencia-> bindParam(':profit', $cotizacion->obtener_profit(), PDO::PARAM_STR);
        $sentencia-> bindParam(':additional', $cotizacion->obtener_additional(), PDO::PARAM_STR);
        $sentencia-> bindParam(':shipping', $cotizacion->obtener_shipping(), PDO::PARAM_STR);
        $sentencia-> bindParam(':shipping_cost', $cotizacion->obtener_shipping_cost(), PDO::PARAM_STR);
        $sentencia-> bindParam(':rfp', $cotizacion-> obtener_rfp(), PDO::PARAM_STR);
        $sentencia-> bindParam(':fullfillment', $cotizacion-> obtener_fullfillment(), PDO::PARAM_STR);
        $resultado = $sentencia-> execute();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
  }
}
?>
