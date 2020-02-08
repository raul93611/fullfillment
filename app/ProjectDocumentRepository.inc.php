<?php
class ProjectDocumentRepository{
  public static function insert_document($connection, $document){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO project_documents(id_fulfillment_project, documents_name, comment, document_date, username) VALUES(:id_fulfillment_project, :documents_name, :comment, NOW(), :username)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $document-> get_id_fulfillment_project(), PDO::PARAM_STR);
        $sentence-> bindParam(':documents_name', $document-> get_documents_name(), PDO::PARAM_STR);
        $sentence-> bindParam(':comment', $document-> get_comment(), PDO::PARAM_STR);
        $sentence-> bindParam(':username', $document-> get_username(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_project_documents_by_project($connection, $id_fulfillment_project){
    $documents = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM project_documents WHERE id_fulfillment_project = :id_fulfillment_project ORDER BY document_date DESC';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $documents[] = new ProjectDocument($row['id'], $row['id_fulfillment_project'], $row['documents_name'], $row['comment'], $row['document_date'], $row['username']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $documents;
  }
}
?>
