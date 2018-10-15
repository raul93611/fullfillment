<?php
class CommentRfqFullFillment{
  private $id;
  private $id_rfq;
  private $nombre_susuario;
  private $comment;
  private $fecha_comment;

  public function __construct($id, $id_rfq, $nombre_susuario, $comment, $fecha_comment){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> nombre_usuario = $nombre_susuario;
    $this-> comment = $comment;
    $this-> fecha_comment = $fecha_comment;
  }

  public function obtener_id(){
    return $this-> id;
  }

  public function obtener_id_rfq(){
    return $this-> id_rfq;
  }

  public function obtener_nombre_usuario(){
    return $this-> nombre_usuario;
  }

  public function obtener_comment(){
    return $this-> comment;
  }

  public function obtener_fecha_comment(){
    return $this-> fecha_comment;
  }
}
?>
