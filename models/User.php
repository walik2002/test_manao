<?php
class User {
    public $login;
    private $password;
    private $email;
    private $name;
  
    public function __construct($login, $password, $email, $name) {
      $this->login = $login;
      $this->email = $email;
      $this->name = $name;
      
      // Generate a random salt
      $salt = bin2hex(random_bytes(16));
      
      // Encrypt the password with the salt and MD5 hash
      $this->password = $salt . md5($password . $salt);
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
      $hash = $salt . md5($password . $salt);
      
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