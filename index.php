<?php
session_start();
ob_start();

$route = trim($_SERVER['REQUEST_URI'], '/');
if (empty($route)) {
    $route = 'home';
}

$content = '';
switch ($route) {
    case 'home':
        $content = 'pages/home.php';
        break;
    case 'register':
    case 'registration':
        $content = 'pages/registration.php';
        break;
    case 'login':
        $content = 'pages/login.php';
        break;
    default:
        $content = 'pages/404.php';
        break;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Px Forum</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav>
        <?php include 'pages/menu.php'; ?>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <?php 
                if (file_exists($content)) {
                    include_once $content;
                } else {
                    include_once 'pages/404.php';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>