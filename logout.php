<?php
session_start(); // Start the session if it hasn't been started already

// Unset all session variables
$_SESSION = array();

// If you want to destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

$_SESSION['loggedin']=false;

// Finally, destroy the session
session_destroy();

// Redirect to login page or another page
header("Location: index.php?page=home");
exit();
?>
