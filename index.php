<?php
require_once("private/classes/sessionManager/class__sessionManager.php");
require_once("private/config/db__config.php");
require_once("private/libraries/htmlpurifier/Purifier.php");
require_once("private/functions/removeBrTags.php");

// Enable full error reporting for debugging
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$isLoggedIn = SessionManager::isLoggedIn();
if ($isLoggedIn) {
    $userData = SessionManager::getUserData();
}

// Get the current URL and query parameters
$currentUrl = $_SERVER['REQUEST_URI'];

// Check if the 'page' parameter exists in the query string
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];

    // Redirect to clean URL format (/page/x) if query string is present
    if (strpos($currentUrl, "/page/") === false) {
        header("Location: /page/$page", true, 301); // Permanent redirect to clean URL
        exit();
    }
} else {
    $page = 1; // Default page is 1
}

// If the page number is less than 1, treat it as a 404 error
if ($page < 1) {
    header('HTTP/1.0 404 Not Found');
    header('Location: /'); // Redirect to the homepage
    exit;
}

// If the page is 1, redirect to the root URL (homepage)
if ($page == 1 && strpos($currentUrl, "/page/") !== false) {
    header("Location: /", true, 301);
    exit();
}



// Set language and category filters
$LANGUAGES = ["marathi", "hindi"];
$CATEGORIES = ["story", "poetry", "poem", "article"];

// Logic to handle language and category filters
if (isset($QueryData[0]) && in_array($QueryData[0], $LANGUAGES)) {
    if (isset($QueryData[1]) && in_array($QueryData[1], $CATEGORIES)) {
        // Handle filtered content
    }
}

// Page title and meta
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if ($page == 1): ?>
    <title>Homepage | Lekhak.in</title>
    <link rel="canonical" href="https://lekhak.in/" />
    <?php else : ?>
    <title>Posts - Page <?php echo $page; ?> | Lekhak.in</title>
    <link rel="canonical" href="https://lekhak.in/page/<?php echo $page; ?>" />
    <?php endif; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=DM+Serif+Display:ital@0;1&family=Yatra+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton+SC&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=DM+Serif+Display:ital@0;1&family=Hammersmith+One&family=Yatra+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <?php
    require_once('assets/css/homepage/style.css.php');
    ?>

</head>
<body class="bg-white">
    
    <header>
        <?php
        require_once('private/components/navbar.php');
        ?>
    </header>
    
    
    <main>
        <?php
        require_once("private/components/homepage/loadCompetitions.php");
        require_once("private/components/homepage/loadCategories.php");
        require_once("private/components/homepage/loadPoems.php");
        require_once("private/components/homepage/loadPosts.php");
        require_once("private/components/homepage/pagination.php");
        ?>
    </main>
    
    
    <footer>
        <?php
        require_once("private/components/footer.php");
        ?>
    </footer>
    
</body>
</html>