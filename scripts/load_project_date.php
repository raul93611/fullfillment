<?php
ConnectionFullFillment::open_connection();
$date = ProjectDateRepository::get_date_by_id(ConnectionFullFillment::get_connection(), $id_project_date);
ConnectionFullFillment::close_connection();
$project_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($date-> get_date());
?>
<div class="modal-body">
  <div class="form-group">
    <label>Date:</label>
    <input type="text" disabled class="form-control form-control-sm" value="<?php echo $project_date; ?>">
  </div>
  <div class="form-group">
    <label>Comment:</label>
    <textarea rows="5" disabled class="form-control form-control-sm"><?php echo $date-> get_comment(); ?></textarea>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger remove_project_date" data="<?php echo $id_project_date; ?>" name="button"><i class="fas fa-times"></i> Remove</button>
</div>
