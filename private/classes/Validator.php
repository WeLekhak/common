<?php

class Validator {

  // Validate First Name
  public static function validateFirstName($firstName) {
    // Allow Unicode letters, spaces, minimum 2 characters, maximum 50 characters
    if (preg_match("/^[\p{L}\s]{2,50}$/u", $firstName)) {
      return [
        'success' => true,
        'message' => 'First name is valid.'
      ];
    } else {
      return [
        'success' => false,
        'message' => 'First name must be between 2 and 50 characters long and can only contain letters and spaces.'
      ];
    }
  }

  // Validate Last Name
  public static function validateLastName($lastName) {
    // Allow Unicode letters, spaces, minimum 2 characters, maximum 50 characters
    if (preg_match("/^[\p{L}\s]{2,50}$/u", $lastName)) {
      return [
        'success' => true,
        'message' => 'Last name is valid.'
      ];
    } else {
      return [
        'success' => false,
        'message' => 'Last name must be between 2 and 50 characters long and can only contain letters and spaces.'
      ];
    }
  }

  // Validate Mobile Number
  public static function validateMobile($mobile) {
    if (preg_match("/^[0-9]{10}$/", $mobile)) {
      return [
        'success' => true,
        'message' => 'Mobile number is valid.'
      ];
    } else {
      return [
        'success' => false,
        'message' => 'Mobile number must be exactly 10 digits long and can only contain numbers.'
      ];
    }
  }

  // Validate Email
  public static function validateEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return [
        'success' => true,
        'message' => 'Email is valid.'
      ];
    } else {
      return [
        'success' => false,
        'message' => 'Invalid email format.'
      ];
    }
  }

  public static function validatePassword($password) {
    // Allows only English letters and special characters, minimum 8 characters
    if (preg_match("/^[a-zA-Z0-9!@#$%^&*()_\-+=<>?]{8,}$/", $password)) {
      return [
        'success' => true,
        'message' => 'Password is valid.'
      ];
    } else {
      return [
        'success' => false,
        'message' => 'Password must be at least 8 characters long and can only contain English letters and special characters (!@#$%^&*()_-+=<>?).'
      ];
    }
  }
}

// Example Usage
/**
// Validate First Name
$firstNameValidation = Validator::validateFirstName('Jörg');
if ($firstNameValidation['success']) {
echo $firstNameValidation['message'];
} else {
echo $firstNameValidation['message'];
}

// Validate Last Name
$lastNameValidation = Validator::validateLastName('García');
if ($lastNameValidation['success']) {
echo $lastNameValidation['message'];
} else {
echo $lastNameValidation['message'];
}

// Validate Mobile Number
$mobileValidation = Validator::validateMobile('9373052424');
if ($mobileValidation['success']) {
echo $mobileValidation['message'];
} else {
echo $mobileValidation['message'];
}

// Validate Email
$emailValidation = Validator::validateEmail('example@example.com');
if ($emailValidation['success']) {
echo $emailValidation['message'];
} else {
echo $emailValidation['message'];
}

// Example Usage
$passwordValidation = Validator::validatePassword('P@ssw0rd!');
if ($passwordValidation['success']) {
echo $passwordValidation['message'];
} else {
echo $passwordValidation['message'];
}

**/
?>
