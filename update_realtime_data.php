// update_realtime_data.php
<?php
include 'config.php'; // Include the configuration file

function updateGlobalVariables() {
    global $link; // Assuming $link is your database connection
    
    // Perform database query to fetch real-time data
    $sql = "SELECT * FROM account";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['fname'] = $row['fname']; // Update globalVariable1
        $_SESSION['lname'] = $row['lname']; // Update globalVariable2
        // Update more global variables as needed
    } else {
        echo "0 results";
    }
}

updateGlobalVariables(); // Call the function to update global variables
?>
