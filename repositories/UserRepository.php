<?php
    require_once '..\\models\\User.php';
    interface UserRepository {
        public function create(User $user): bool;
        public function read(string $login): ?User;
        public function update(User $user): bool;
        public function delete(string $login): bool;
    }
?>