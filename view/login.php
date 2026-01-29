<?php

$username = $_COOKIE['username'] ?? '';

?>

<form>
  <div class="mb-3">
    <label for="username" class="form-label" value="<?= $username ?>">Username</label>
    <input type="text" class="form-control">
    <div id="emailHelp" class="form-text">3–20 characters, only letters, numbers, and underscores</div>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input">
    <label class="form-check-label" for="remeber">Remember me</label>
  </div>
  <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>