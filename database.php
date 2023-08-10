<?php
class DatabaseConnection {
    private static $pdo = null;

    public static function connect(
        $host,
        $username,
        $password,
        $database,
        $charset = 'utf8',
        $driverOptions = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            // Add more attributes with default values here if needed
        ]
    ) {
        if (self::$pdo === null) {
            try {
                $dsn = "mysql:host={$host};dbname={$database};charset={$charset}";
                self::$pdo = new PDO($dsn, $username, $password, $driverOptions);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}

// Usage example:

$host = 'your_database_host';
$username = 'your_database_username';
$password = 'your_database_password';
$database = 'your_database_name';
$charset = ''; // Leave empty to use default UTF-8.
$driverOptions = [
    // Add additional driver options here if needed
];

$pdo = DatabaseConnection::connect($host, $username, $password, $database, $charset, $driverOptions);

// Now you can use $pdo to perform various database operations using PDO.
