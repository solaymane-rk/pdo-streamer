<?php

$username = $_COOKIE['username'] ?? '';

?>

<form method="post" action="">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" id="username" name="username" class="form-control" value="<?= $username ?>">
    <div id="emailHelp" class="form-text">3-20 characters, only letters, numbers, and underscores</div>
  </div>
  <div class="mb-3 form-check">
    <label class="form-check-label" for="remember">Remember me</label>
    <input type="checkbox" id="remember" name="remember" class="form-check-input">
  </div>
  <button type="submit" class="btn btn-primary" name="action" value="processLogin">Login</button>

  <?php if (isset($_SESSION['error'])): ?>
    <p class="text-danger"><?= $_SESSION['error'] ?></p>
  <?php endif; ?>
  
</form>