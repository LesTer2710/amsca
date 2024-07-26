<?php
// Include config file
require_once "config.php";

if (isset($_GET["id"])) {
    $userId = $_GET["id"];

    // Attempt delete query execution
    $sql = "DELETE FROM account WHERE userId = '$userId'";

    if (mysqli_query($link, $sql)) {
        // Records deleted successfully. Prepare the alert message
        $message = "User's Account Successfully Deleted";
        $alertType = "success";
    } else {
        $message = "ERROR: Could not execute $sql. " . mysqli_error($link);
        $alertType = "danger";
    }

    // Close connection
    mysqli_close($link);

    // Inject the alert into the HTML
    echo "<div class='alert alert-$alertType alert-dismissible fade show' role='alert'>
            $message
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'index.php?page=viewUsers';
            }, 1500);
        </script>";
}
?>
