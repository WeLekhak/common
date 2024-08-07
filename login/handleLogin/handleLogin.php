<?php

class UserLogin {
  public static function validateMobile($mobile) {
    return preg_match('/^\d{10}$/', $mobile);
  }

  public static function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  public static function validateUsername($username) {
    return preg_match('/^[a-zA-Z]+$/', $username);
  }

  public static function validatePassword($password) {
    return !empty($password);
  }

  public static function checkSuspiciousText($input) {
    return preg_match('/^[a-zA-Z0-9@._-]*$/', $input);
  }

  public static function getUserRecords($loginId) {
    $sqlquery = 'SELECT * FROM lekhak_users
                 WHERE lekhak_mobile_number = :loginId
                 OR lekhak_email = :loginId
                 OR lekhak_username = :loginId';
    $params = [':loginId' => $loginId];
    return DatabaseConnection::Query($sqlquery, $params);
  }

  public static function authenticate($loginId, $password) {
    // Detect the type of login ID and validate it
    if (self::validateMobile($loginId)) {
      $loginType = 'mobile';
    } elseif (self::validateEmail($loginId)) {
      $loginType = 'email';
    } elseif (self::validateUsername($loginId)) {
      $loginType = 'username';
    } else {
      // return "Invalid login ID.";
    }

    if (!self::validatePassword($password)) {
      return "Invalid password.";
    }

    if (!self::checkSuspiciousText($loginId) || !self::checkSuspiciousText($password)) {
      return "Suspicious input detected.";
    }

    $result = self::getUserRecords($loginId);



    if (!empty($result)) {
      foreach ($result as $user) {
        $hashed_password = $user["lekhak_password"];
        if (password_verify($password, $hashed_password)) {
          return ['status' => 'success',
            'data' => $user];
        }
      }
      return "Wrong password.";
    } else {
      return "Unregistered user.";
    }
  }

  public static function login($loginId, $password) {
    return self::authenticate($loginId, $password);
  }
}
/**
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$loginId = $_POST['loginId'] ?? '';
$password = $_POST['password'] ?? '';

$loginResult = UserLogin::login($loginId, $password);

if (is_array($loginResult) && $loginResult['status'] === 'success') {
echo "Login successful!";
echo '<pre>';
print_r($loginResult['data']);
echo '</pre>';
} else {
echo $loginResult;
}
}
**/
?>