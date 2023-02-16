<?php
  if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    echo '<form id="auth-form" method="POST" action="login.php">

    <h3>Authorization</h3>
    
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <input type="submit" value="Login" class="form-button">
    </form>';
  }
?>