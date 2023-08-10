<?php

class DatabaseConnection {
    private $host;
    private $username;
    private $password;
    private $database;
    private $charset;
    private $pdo;

    public function __construct(
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
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->charset = empty($charset) ? 'utf8' : $charset;

        $this->connect($driverOptions);
    }

    private function connect($driverOptions) {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset}";
            $this->pdo = new PDO($dsn, $this->username, $this->password, $driverOptions);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getPDO() {
        return $this->pdo;
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

$databaseConnection = new DatabaseConnection($host, $username, $password, $database, $charset, $driverOptions);
$pdo = $databaseConnection->getPdo();

// Now you can use $pdo to perform various database operations using PDO.

?>
