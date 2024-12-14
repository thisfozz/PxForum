<?php

class User{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register(UserEntity $user) {
        try {
            $sql = 'SELECT * FROM "user" WHERE "login" = :login';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':login', $user->GetLogin(), PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->fetch()) {
                return ["success" => false, "message" => "User exists"];
            }
    
            $sql = 'SELECT role_id FROM role WHERE role_name = :role_name';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':role_name', 'User', PDO::PARAM_STR);
            $stmt->execute();
    
            $role = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$role) {
                throw new Exception("Default role 'User' not found");
            }
    
            $password_hash = password_hash($user->GetPasswordHash(), PASSWORD_DEFAULT);
    
            $sql = 'INSERT INTO "user" (
                user_id, login, email, password_hash, role_id, display_name
            ) VALUES (
                :user_id, :login, :email, :password_hash, :role_id, :display_name
            )';
    
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->bindValue(':user_id', $user->GetId(), PDO::PARAM_STR);
            $stmt->bindValue(':login', $user->GetLogin(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->GetEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':role_id', $role['role_id'], PDO::PARAM_STR);
            $stmt->bindValue(':display_name', $user->GetDisplayName(), PDO::PARAM_STR);
    
            $stmt->execute();
            return ["success" => true, "message" => "Registration successful"];
    
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function login(UserEntity $user) {
        try {
            $sql = 'SELECT * FROM "user" WHERE login = :login OR email = :email';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':login', $user->GetLogin(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->GetEmail(), PDO::PARAM_STR);
            $stmt->execute();
    
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$userData) {
                return ["success" => false, "message" => "User not found"];
            }
    
            // Проверяем введённый пароль с хешем из базы
            if (!password_verify($user->GetPasswordHash(), $userData['password_hash'])) {
                return ["success" => false, "message" => "Invalid password"];
            }
    
            setcookie('user_login', $userData['login'], time() + 3600, '/');
            setcookie('user_email', $userData['email'], time() + 3600, '/');
    
            return ["success" => true, "message" => "Login successful"];
    
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
?>