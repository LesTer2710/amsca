<?php
require_once "config.php";
session_start(); // Start the session

// Check if input fields are set
if (isset($_POST['inputQaptcha']) && isset($_POST['captcha'])) {
    $inputQaptcha = $_POST['inputQaptcha'];
    $captcha = $_POST['captcha'];

    // Check if user is logged in
    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];

        // Retrieve account details from the database
        $query = "SELECT * FROM account WHERE userId = '$userId'";
        $result = mysqli_query($link, $query);
        
        if (!$result) {
            die("Error in query: $query ." . mysqli_error($link));
        }

        $row = mysqli_fetch_assoc($result);
        $taskpoints = $row['task-rewards'];

        // Verify CAPTCHA
        if ($inputQaptcha == $captcha) {
            // Update task points
            $newTaskpoints = round(($taskpoints + 0.01), 2);
            $sql2 = "UPDATE account SET `task-rewards` = $newTaskpoints WHERE userId = '$userId'";
            $result2 = mysqli_query($link, $sql2);

            if (!$result2) {
                die("Error in query: $sql2 ." . mysqli_error($link));
            }

            header('Location: index.php?page=Qaptcha');
            exit();
        } else {
            echo "Your entry doesn't match the captcha.";
        }
    } else {
        echo "User not logged in.";
    }
} else {
    echo "Captcha values not set.";
}

mysqli_close($link);
?>
