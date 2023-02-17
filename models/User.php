<?php
class User {
  public $login;
  private $password;
  private $email;
  private $name;

  public function __construct($login, $hashedPassword, $email, $name) {
      $this->login = $login;
      $this->email = $email;
      $this->name = $name;
      $this->password = $hashedPassword;
  }

  public function getLogin() {
      return $this->login;
  }

  public function getPassword() {
      return $this->password;
  }

  public function getEmail() {
      return $this->email;
  }

  public function getName() {
      return $this->name;
  }

  public function verifyPassword($password) {
      // Extract the salt from the stored password hash
      $salt = substr($this->password, 0, 32);
    
      // Calculate the hash of the input password with the salt
      $hash = $salt . sha1($password . $salt);

      // Compare the calculated hash with the stored password hash
      return $hash === $this->password;
  }

  public function toArray() {
      return array(
          'login' => $this->login,
          'password' => $this->password,
          'email' => $this->email,
          'name' => $this->name
      );
  }
}
?>