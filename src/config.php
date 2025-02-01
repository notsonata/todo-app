<?php
// config.php
function connect_with_retry($host, $user, $password, $database, $retries = 5, $delay = 2) {
    for ($i = 0; $i < $retries; $i++) {
        try {
            $db = mysqli_connect($host, $user, $password, $database);
            if ($db) {
                return $db;
            }
        } catch (Exception $e) {
            if ($i === $retries - 1) {
                die("Connection failed after {$retries} attempts: " . $e->getMessage());
            }
            sleep($delay);
        }
    }
    return false;
}

$db = connect_with_retry(
    getenv('DB_HOST') ?: 'localhost',
    getenv('DB_USER') ?: 'root',
    getenv('DB_PASSWORD') ?: '',
    getenv('DB_NAME') ?: 'todo'
);
?>