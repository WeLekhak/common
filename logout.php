<?php
require_once("private/classes/sessionManager/class__sessionManager.php");

// Log out the user
SessionManager::logoutUser();

// Redirect to the login page
SessionManager::redirect('index.php');
?>
