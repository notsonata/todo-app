<?php
// config.php
function connect_with_retry($host, $user, $password, $database, $retries = 30, $delay = 2) {
    // Add error logging
    error_log("Attempting to connect to database at host: $host");
    
    for ($i = 0; $i < $retries; $i++) {
        try {
            // Create mysqli object
            $db = new mysqli($host, $user, $password, $database);
            
            // Check connection
            if ($db->connect_error) {
                error_log("Connection attempt $i failed: " . $db->connect_error);
                if ($i === $retries - 1) {
                    die("Connection failed after {$retries} attempts: " . $db->connect_error);
                }
                sleep($delay);
                continue;
            }
            
            error_log("Successfully connected to database");
            return $db;
        } catch (Exception $e) {
            error_log("Connection attempt $i failed with exception: " . $e->getMessage());
            if ($i === $retries - 1) {
                die("Connection failed after {$retries} attempts: " . $e->getMessage());
            }
            sleep($delay);
        }
    }
    return false;
}

// Get environment variables with explicit error checking
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$dbName = getenv('DB_NAME');

// Log the connection attempt
error_log("Attempting database connection with:");
error_log("Host: $dbHost");
error_log("User: $dbUser");
error_log("Database: $dbName");

if (!$dbHost || !$dbUser || !$dbPassword || !$dbName) {
    die("Missing required database environment variables");
}

// Increase retries and delay for Render's environment
$db = connect_with_retry($dbHost, $dbUser, $dbPassword, $dbName, 30, 2);

if (!$db) {
    die("Failed to connect to database after maximum retries");
}
?>