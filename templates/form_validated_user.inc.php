<div class="card-body">
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username ..." autofocus required <?php $validator-> show_username(); ?>>
    <?php $validator-> show_username_error(); ?>
  </div>
  <div class="form-group">
    <label for="password1">Password:</label>
    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password ..." required>
    <?php $validator-> show_password1_error(); ?>
  </div>
  <div class="form-group">
    <label for="password2">Confirm password:</label>
    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm password ..." required>
    <?php $validator-> show_password2_error(); ?>
  </div>
  <div class="form-group">
    <label for="names">First names:</label>
    <input type="text" class="form-control" id="names" name="names" placeholder="First names ..." required <?php $validator-> show_names(); ?>>
    <?php $validator-> show_names_error(); ?>
  </div>
  <div class="form-group">
    <label for="last_names">Last names:</label>
    <input type="text" class="form-control" id="last_names" name="last_names" placeholder="Last names ..." required <?php $validator-> show_last_names(); ?>>
    <?php $validator-> show_last_names_error(); ?>
  </div>
  <div class="form-group">
    <label for="email">E-mail:</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email ..." required <?php $validator-> show_email() ?>>
  </div>
</div>
<div class="card-footer">
  <button type="submit" class="btn btn-success" name="sign_in"><i class="fa fa-check"></i> Sign in</button>
</div>
