<?php
ConnectionFullFillment::open_connection();
$fulfillment_project = FulfillmentProjectRepository::get_fulfillment_project_by_id(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
ConnectionFullFillment::close_connection();
?>
<div class="col-md-12">
  <?php
  ConnectionFullFillment::open_connection();
  $project_documents = ProjectDocumentRepository::get_all_project_documents_by_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
  ConnectionFullFillment::close_connection();
  ?>
  <div class="list-group">
    <?php
    if(count($project_documents)){
      foreach ($project_documents as $key => $project_document) {
        $document_date = RepositorioRfqFullFillmentComment::mysql_datetime_to_english_format($project_document-> get_document_date());
        ?>
        <li href="#" class="list-group-item list-group-item-action list-group-flush flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 text-primary font-weight-bold">Comment</h5>
            <small><?php echo $document_date; ?></small>
          </div>
          <p class="mb-1"><?php echo nl2br($project_document-> get_comment()); ?></p>
          <small class="text-primary"><?php echo $project_document-> get_username(); ?></small>
          <h5 class="text-primary font-weight-bold">Documents</h5>
          <?php
          $documents_name = explode(',', $project_document-> get_documents_name());
          foreach ($documents_name as $key => $document_name) {
            ?>
            <a href="<?php echo SERVER . 'documents/rfp_team/' . $fulfillment_project-> get_id_project() . '/' . $document_name; ?>" download class="d-block"><i class="fas fa-file"></i> <?php echo $document_name; ?></a>
            <?php
          }
          ?>
        </li>
        <?php
      }
    }
    ?>
  </div>
</div>
