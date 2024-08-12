<?php

class DataExists {
  private static $pdo;

  // Initialize the PDO instance from DatabaseConnection
  public static function initialize() {
    self::$pdo = DatabaseConnection::getPdo();
  }

  // Check if the email exists in the database
  public static function emailExists($email) {
    $sql = "SELECT COUNT(*) FROM lekhak_users WHERE lekhak_email = :lekhak_email";
    $params = [':lekhak_email' => $email];
    $stmt = self::$pdo->prepare($sql);
    $results = $stmt->execute($params);
    $count = $stmt->fetchColumn();
    return $count > 0;

  }

  // Check if the phone number exists in the database
  public static function phoneExists($phone) {
    $sql = "SELECT COUNT(*) FROM lekhak_users WHERE lekhak_mobile_number = :lekhak_mobile_number";
    $params = [':lekhak_mobile_number' => $phone];
    $stmt = self::$pdo->prepare($sql);
    $results = $stmt->execute($params);
    $count = $stmt->fetchColumn();
    return $count > 0;
    
  }
}

// Usage example:
/**
// Initialize DatabaseConnection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'lekhakin_masterdb';
$charset = ''; // Leave empty to use default UTF-8.
$driverOptions = [
// Add additional driver options here if needed
];

DatabaseConnection::initialize($host, $username, $password, $database, $charset, $driverOptions);

// Initialize DataExists class
DataExists::initialize();

// Check if email or phone exists
$emailToCheck = 'test@example.com';
$phoneToCheck = '1234567890';

if (DataExists::emailExists($emailToCheck)) {
echo "Email already exists.";
} else {
echo "Email is available.";
}

if (DataExists::phoneExists($phoneToCheck)) {
echo "Phone number already exists.";
} else {
echo "Phone number is available.";
}

**/
?>