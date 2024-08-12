<?php

class Sanitizer {

    /**
     * Sanitize a name input.
     * 
     * @param string $name
     * @return string
     */
    public static function sanitizeName($name) {
        // Remove leading and trailing whitespace
        $name = trim($name);
        
        // Escape any special characters
        return htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize an email input.
     * 
     * @param string $email
     * @return string
     */
    public static function sanitizeEmail($email) {
        // Remove leading and trailing whitespace
        $email = trim($email);
        
        // Escape any special characters
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Sanitize a phone number input.
     * 
     * @param string $phone
     * @return string
     */
    public static function sanitizePhone($phone) {
        // Remove all non-numeric characters
        return preg_replace('/\D/', '', $phone);
    }

    /**
     * Sanitize a password input (though generally, sanitization is less critical for passwords).
     * 
     * @param string $password
     * @return string
     */
    public static function sanitizePassword($password) {
        // Typically passwords do not require extensive sanitization, just trimming
        return trim($password);
    }
}

?>
