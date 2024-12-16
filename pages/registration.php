<?php

require_once dirname(__DIR__) . '/classes/entities/UserEntity.php';
require_once dirname(__DIR__) . '/classes/User.php';
require_once dirname(__DIR__) . '/includes/db.php'; 

if (!isset($_POST["regbtn"])) {
    echo '
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form action="" method="POST" class="p-4 border rounded shadow-sm bg-light" style="width: 300px;">
            <h3 class="mb-3 text-center">Sign Up</h3>
            <div class="mb-3">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="regbtn">Register</button>
            <div class="mt-3 text-center">
                <small>Already have an account? <a href="/login">Sign in</a></small>
            </div>
        </form>
    </div>
    ';
} else {
    try{
        $db = new Database();
        $pdo = $db->connect();

        $userEntity = new UserEntity(
            $_POST['username'],
            $_POST['email'],
            $_POST['password']
        );

        $user = new User($pdo);
        $result = $user->register($userEntity);

        if($result['success']){
            header('Location: /home');
        } else{
            echo '<p class="text-danger text-center">' . $result['message'] . '</p>';
            echo '<a href="/register" class="btn btn-link d-block text-center">Try Again</a>';
        } 
        } catch (Exception $e) {
            echo '<p class="text-danger text-center">Error: ' . $e->getMessage() . '</p>';
            echo '<a href="/register" class="btn btn-link d-block text-center">Try Again</a>';
        }
    } 
    
?>