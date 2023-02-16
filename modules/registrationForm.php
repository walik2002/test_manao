<form id="reg-form" method="POST" action="controllers/registration.php">
  <h3>Registration</h3>
  <label for="login">Login:</label>
  <input type="text" id="login" name="login" required  title="Minimum 6 characters">
  <span id="login-error" class="error"></span>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required  title="Minimum 6 characters, at least one letter and one number">
  <span id="password-error" class="error"></span>

  <label for="confirm_password">Confirm Password:</label>
  <input type="password" id="confirm_password" name="confirm_password" required  title="Minimum 6 characters, at least one letter and one number">
  <span id="confirm_password-error" class="error"></span>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>
  <span id="email-error" class="error"></span>

  <label for="name">Name:</label>
  <input type="text" id="name" name="name" required  title="Minimum 2 characters, letters only">
  <span id="name-error" class="error"></span>

  <input type="submit" value="Register" id="register-btn" class="form-button">
</form>



