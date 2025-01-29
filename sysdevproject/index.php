<?php
session_start();

// Function to generate a random string for 2FA
function getRandomString($n) {
    return bin2hex(random_bytes($n / 2));
}

// Initialize 2FA session if not set
if (!isset($_SESSION["2FA"])) {
    $code = getRandomString(6);
    $_SESSION['2FA'] = $code;
}

// Get controller, action, and language from the URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : "home"; // Default to Home
$action = isset($_GET['action']) ? $_GET['action'] : "index"; // Default to index
$language = isset($_GET['lang']) ? $_GET['lang'] : "en"; // Default to English

// Convert controller name to class format
$controllerClassName = ucfirst($controller) . "Controller";

// Include the appropriate controller file
$controllerFilePath = "Controllers/$controllerClassName.php";

// Include the language file
$languageFilePath = "Languages/$language.php";
if (file_exists($languageFilePath)) {
    include_once $languageFilePath;
} else {
    die("Error: Language file '$languageFilePath' not found.");
}

// Custom routing for specific views
if ($controller === "reservationSummary" && $action === "index") {
    // Include the reservation summary view
    include "Views/Reservation/reservationSummary.php";
    exit();
}

// Check if the controller file exists
if (file_exists($controllerFilePath)) {
    include_once $controllerFilePath;

    // Instantiate the controller and call its route method
    if (class_exists($controllerClassName)) {
        $ct = new $controllerClassName();
        $ct->route();
    } else {
        die("Error: Controller class '$controllerClassName' not found.");
    }
} else {
    die("Error: Controller file '$controllerFilePath' not found.");
}
?>
