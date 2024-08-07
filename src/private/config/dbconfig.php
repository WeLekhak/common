<?php

class DatabaseConnection {
  private static $host;
  private static $username;
  private static $password;
  private static $database;
  private static $charset;
  private static $pdo;
  private static $lastStatement;
  private static $lastQuerySuccess;
  private static $lastErrorMessage;

  public static function initialize(
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
    self::$host = $host;
    self::$username = $username;
    self::$password = $password;
    self::$database = $database;
    self::$charset = empty($charset) ? 'utf8' : $charset;

    self::connect($driverOptions);
  }

  private static function connect($driverOptions) {
    try {
      $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$database . ";charset=" . self::$charset;
      self::$pdo = new PDO($dsn, self::$username, self::$password, $driverOptions);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  public static function getPdo() {
    return self::$pdo;
  }

  public static function query($sql, $params = [], $fetchAll = true) {
    try {
      $pdo = self::getPdo();
      self::$lastStatement = $pdo->prepare($sql);

      // Bind parameters
      foreach ($params as $key => $value) {
        self::$lastStatement->bindValue($key, $value);
      }

      self::$lastQuerySuccess = self::$lastStatement->execute();

      if (self::$lastQuerySuccess) {
        return $fetchAll ? self::$lastStatement->fetchAll() : self::$lastStatement->fetch();
      } else {
        self::$lastErrorMessage = self::$lastStatement->errorInfo()[2];
        return false;
      }
    } catch (PDOException $e) {
      // Log the error message or handle it as needed
      error_log("Query failed: " . $e->getMessage());
      self::$lastErrorMessage = $e->getMessage();
      self::$lastQuerySuccess = false;
      return false;
    }

  }

  public static function rowCount() {
    return self::$lastStatement ? self::$lastStatement->rowCount() : 0;
  }
  public static function querySuccess() {
    return self::$lastQuerySuccess;
  }

  public static function getLastErrorMessage() {
    return self::$lastErrorMessage;
  }
}

// Usage example:

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'lekhakin_masterdb';
$charset = ''; // Leave empty to use default UTF-8.
$driverOptions = [
  // Add additional driver options here if needed
];

DatabaseConnection::initialize($host, $username, $password, $database, $charset, $driverOptions);

$__pdo = DatabaseConnection::getPdo();

// Now you can use $__pdo to perform various database operations using PDO.


// Query example with named parameters
/*
$sql = "SELECT * FROM users WHERE username = :username AND created_at > :created_at";
$params = [
  ':username' => 'john_doe',
  ':created_at' => '2023-01-01'
];
$result = DatabaseConnection::query($sql, $params);

// Get the number of rows retrieved
$rowCount = DatabaseConnection::rowCount();
*/
?>