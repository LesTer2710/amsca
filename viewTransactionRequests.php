<?php
// Include config file
require_once "config.php";

$userId = $_SESSION['userId'];
$condition = "";
$evalcondition ="All Records";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['condition'])) {
        $evalcondition = $_POST['condition'];
        if ($evalcondition == "Completed") {
            $condition = "WHERE transstatus='Completed'";
        } else if ($evalcondition == "Processing") {
            $condition = "WHERE transstatus='Processing'";
        }else if ($evalcondition == "Cancelled") {
            $condition = "WHERE transstatus='Cancelled'";
        } else if ($evalcondition == "Recharge") {
            $condition = "WHERE transtype='Recharge'";
        } else if ($evalcondition == "Cashout") {
            $condition = "WHERE transtype='Cashout'";
        }
        else{
            $condition="";
        }
    }
}

$sql = "SELECT * FROM mytransaction $condition ORDER BY mytransaction.transdate DESC";
$result = mysqli_query($link, $sql);

echo '<br/>';
    echo "<h2>Transaction Requests</h2>";
    echo "<p>There are <b>" . mysqli_num_rows($result) . "</b> transaction requests.</p>";
    
    echo "<form id='filterForm' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=viewTransactionRequests' method='post'>";
    echo "<div class='row'>";
        echo "<div class='col'>";
        echo "</div>";
        echo "<div class='col'>";
             echo "<select class='form-select form-control' aria-label='Default select example' id='condition' name='condition' onchange='document.getElementById(\"filterForm\").submit();'>
                                        <option selected value=''>".$evalcondition."</option>
                                        <option value='Completed'>Status-Completed</option>
                                        <option value='Processing'>Status-Processing</option>
                                        <option value='Cancelled'>Status-Cancelled</option>
                                        <option value='Recharge'>Type-Recharge</option>
                                        <option value='Cashout'>Type-Cashout</option>
                                        <option value='All Records'>All Records</option>
                                    </select>";
        echo "</div>";
    echo "</div>";
    echo "</form>";

if (mysqli_num_rows($result) > 0) {
    

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
    echo "<br/>";
    echo "<div class='table-responsive-custom'>";
    echo "<table class='table table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Reference Number</th>";
    echo "<th>User ID</th>";
    echo "<th>Transaction Date</th>";
    echo "<th>Transaction Type</th>";
    echo "<th>Amount</th>";
    echo "<th>Account Number</th>";
    echo "<th>Status</th>";
    echo "<th>Mark as Complete</th>";
    echo "<th>Cancel</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['refnum'] . "</td>";
        echo "<td>" . $row['userId'] . "</td>";
        echo "<td>" . $row['transdate'] . "</td>";
        if ($row['transtype'] == "Recharge") {
            echo "<td><span class='badge badge-warning'>" . $row['transtype'] . "</span></td>";
        } else {
            echo "<td><span class='badge badge-danger'>" . $row['transtype'] . "</span></td>";
        }
        echo "<td>" . $row['transamount'] . "</td>";
        echo "<td>" . $row['transacct'] . "</td>";
        if ($row['transstatus'] == "Processing") {
            echo "<td><font color='red-orange'>" . $row['transstatus'] . "</font></td>";
        } else {
            echo "<td><font color='green'>" . $row['transstatus'] . "</font></td>";
        }
        echo "<td>";
        echo "<a href='index.php?page=markRequests&reqtype=&id=" . $row['refnum'] . "' title='Complete Request' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'>Mark as Complete</span></a>";
        echo "</td>";
        echo "<td>";
        echo "<a href='index.php?page=cancelTransaction&id=" . $row['refnum'] . "' title='Cancel Request' data-toggle='tooltip'><span class='text text-danger'>Cancel</span></a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>"; // Close the responsive table div

    // Free result set
    mysqli_free_result($result);
} else {
    echo "<br/>";
    echo "<h6>No Transaction Requests Found</h6>";
}
?>
