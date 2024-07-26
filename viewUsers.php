<?php
// Include config file
require_once "config.php";

$sql = "SELECT * FROM account";
$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) > 0) {
    // Count results
    echo '<br/>';
    echo "<h2>View Users</h2>";
    echo "<p>There are <b>" . mysqli_num_rows($result) . "</b> users found.</p>";

    echo "
    <style>
        th {
            text-align: center;
            vertical-align: middle;
        }
        @media (max-width: 900px) {
            .table-responsive-custom {
                overflow-x: auto;
            }
        }
    </style>";

    echo "<div class='table-responsive-custom'>";
    echo "<table class='table table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>User ID</th>";
    echo "<th>Username</th>";
    echo "<th>Password</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Gcash</th>";
    echo "<th>Account Type</th>";
    echo "<th>Activation Credits</th>";
    echo "<th>Wallet Balance</th>";
    echo "<th>Referral Bonus</th>";
    echo "<th>Total Balance</th>";
    echo "<th colspan=\"2\">Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['userId'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['fname'] . "</td>";
        echo "<td>" . $row['lname'] . "</td>";
        echo "<td>" . $row['gcash'] . "</td>";
        echo "<td>" . $row['account-type'] . "</td>";
        echo "<td>" . $row['activation-credits'] . "</td>";
        echo "<td>" . $row['task-rewards'] . "</td>";
        echo "<td>" . $row['referral-bonus'] . "</td>";
        echo "<td>" . $row['total-balance'] . "</td>";
        echo "<td>";
        echo "<a href='index.php?page=updateUser&id=". $row['userId'] ."' title='Update User Account' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'> Edit</span></a>";
        echo "</td>";
        echo "<td>";
        echo "<a href='index.php?page=deleteUser&id=". $row['userId'] ."' title='Delete User Account' data-toggle='tooltip'><span class='text text-danger'>Delete</span></a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>"; // Close the responsive table div

    // Free result set
    mysqli_free_result($result);
} else {
    echo "<h3>No Records Found</h3>";
}
?>
