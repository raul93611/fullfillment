<?php
ConnectionFullFillment::open_connection();
$member = MemberRepository::get_member_by_id(ConnectionFullFillment::get_connection(), $id_member);
ConnectionFullFillment::close_connection();
?>
<input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
<div class="modal-body">
  <div class="form-group">
    <label>Names:</label>
    <input type="text" name="names" class="form-control form-control-sm" value="<?php echo $member-> get_names(); ?>">
  </div>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-success" name="button"><i class="fas fa-check"></i> Save</button>
  <button type="button" class="remove_member_button btn btn-danger" data="<?php echo $id_member; ?>" name="button"><i class="fas fa-times"></i> Remove</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
</div>
