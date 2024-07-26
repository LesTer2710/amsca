<?php
require_once "config.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];

        $sql = "SELECT * FROM account WHERE userId = '$userId'"; // Adjust the query as needed
        $result = mysqli_query($link, $sql) or die("Error in query: $sql." . mysqli_error($link));
        $count = mysqli_num_rows($result);


        if ($count > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = ($row['fname'] ." ". $row['lname']);
            $myuserId= $row['userId'];
            $username= $row['username'];
            $accounttype= $row['account-type'];
           

        } else {
            $name = null;
            $myuserId=null;
        }
    
    } else {
        echo 'User not logged in.';
        exit();
    }

    $data = array("name" => $name, "userId" => $accounttype.$myuserId, "username" => $username);

    // Send JSON response
    header('Content-Type: application/json');
    // Return the name as JSON
    echo json_encode($data);
   

    mysqli_close($link);


    

    ?>