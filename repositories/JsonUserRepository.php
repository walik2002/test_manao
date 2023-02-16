<?php

    require_once ("UserRepository.php");
    require_once '..'. DIRECTORY_SEPARATOR .'models'. DIRECTORY_SEPARATOR .'User.php';
    class JsonUserRepository implements UserRepository {
        private $filename;
      
        public function __construct($filename) {
            $this->filename = $filename;

            if (!file_exists($this->filename) || !filesize($this->filename)) {
                file_put_contents($this->filename, '[]');
            }
        }
      
        public function create(User $user): bool {
            // Read existing user data from file
            $json = file_get_contents($this->filename);
            $users = json_decode($json, true);
    
            // Check if user with the same email or login already exists
            $existingUser = array_filter($users, function($u) use ($user) {
                return $u['email'] === $user->getEmail() || $u['login'] === $user->getLogin();
            });
          
            if (count($existingUser) > 0) {
                // User with the same email or login already exists
                return false;
            }
          
            // Append new user data to array
            $users[] = $user->toArray();
          
            // Write the updated array to file as JSON
            $json = json_encode($users, JSON_PRETTY_PRINT);
            return file_put_contents($this->filename, $json) !== false;
        }
      
        public function read(string $login): ?User {
            // Read existing user data from file
            $json = file_get_contents($this->filename);
            $users = json_decode($json, true);
          
            // Find user with matching login
            $matchingUsers = array_filter($users, function($u) use ($login) {
                return $u['login'] === $login;
            });
          
            if (count($matchingUsers) === 0) {
                return null;
            }

            $userData = reset($matchingUsers);

            $user = new User(
                $userData['login'],
                $userData['password'],
                $userData['email'],
                $userData['name']
            );
          
            return $user;
        }
      
        public function update(User $user): bool {
            // Read existing user data from file
            $json = file_get_contents($this->filename);
            $users = json_decode($json, true);
          
            // Find user with matching login
            $matchingUsers = array_filter($users, function($u) use ($user) {
                return $u['login'] === $user->getLogin();
            });
          
            if (count($matchingUsers) === 0) {
                return false;
            }
          
            // Update user data
            $matchingUser = reset($matchingUsers);
            $matchingUser['password'] = $user->getPassword();
            $matchingUser['email'] = $user->getEmail();
            $matchingUser['name'] = $user->getName();
          
            // Write the updated array to file as JSON
            $json = json_encode($users, JSON_PRETTY_PRINT);
            return file_put_contents($this->filename, $json) !== false;
        }
      
        public function delete(string $login): bool {
            // Read existing user data from file
            $json = file_get_contents($this->filename);
            $users = json_decode($json, true);
          
            // Find user with matching login
            $matchingUsers = array_filter($users, function($u) use ($login) {
                return $u['login'] === $login;
            });
          
            if (count($matchingUsers) === 0) {
                // User not found
                return false;
            }
          
            // Remove the user from the array
            $user = array_pop($matchingUsers);
            $index = array_search($user, $users);
            array_splice($users, $index, 1);
          
            // Write the updated array to file as JSON
            $json = json_encode($users, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $json);
          
            return true;
        }
        
    }
?>