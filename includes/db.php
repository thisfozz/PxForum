<?php
class Database {
    private $pdo;

    public function connect() {
        $config = require_once dirname(__DIR__) . '/config/config.php';

        $dsn = "{$config['db_driver']}:host={$config['db_host']};port={$config['db_port']};dbname={$config['db_name']}";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try {
            $this->pdo = new PDO($dsn, $config['db_user'], $config['db_password'], $options);
            return $this->pdo;
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            exit();
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>