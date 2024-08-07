<?php

class DebugManager {
    private static $debugMode = false;

    public static function setDebugMode($debugMode) {
        self::$debugMode = $debugMode;
        if ($debugMode) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(0);
        }
    }

    public static function isDebugMode() {
        return self::$debugMode;
    }
}

// Usage example:
DebugManager::setDebugMode(true); // Enable debugging
// DebugManager::setDebugMode(false); // Disable debugging
