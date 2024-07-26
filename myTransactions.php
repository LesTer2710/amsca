                <br><div class="d-flex justify-content-end">
                    <strong>QWallet Balance: &nbsp; </strong><span id="wallet-balance"></span>
                   
                </div>
                <div  class="d-flex justify-content-end">
                <a href="index.php?page=requestCashout" class="text-primary">Request New Transactions</a>
                </div> <br>

                <script>
                     // =============REALTIME DATA FETCH

            function fetchRealtimeData() {
            
            fetch('fetch_realtimedata.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('wallet-balance').innerText = data.walletbalance;
                    
                    
                })
                .catch(error => console.error('Error fetching realtime data:', error));
        }
    
        // Fetch the realtime data every second
        setInterval(fetchRealtimeData, 1000);
    
        // Initial fetch
        fetchRealtimeData();
                </script>
<?php
// Include config file
require_once "config.php";

$userId=$_SESSION['userId'];




$sql = "SELECT * FROM mytransaction where userId='$userId' order by transdate desc";
$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) > 0) {
    // Count results
    echo '<br/>';
    echo "<h2>Account Transactions</h2>";
    echo "<p>Your account have <b>" . mysqli_num_rows($result) . "</b> transactions.</p>";

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
    echo "<th>Transaction Type</th>";
    echo "<th>Amount</th>";
    echo "<th>Account Number</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['refnum'] . "</td>";
        if( $row['transtype']=="Recharge"){
            echo "<td><span class=\"badge badge-warning\">".$row['transtype']. "</span></td>";
        }
        else{
            echo "<td><span class=\"badge badge-danger\">".$row['transtype']. "</span></td>";
        }

        echo "<td>" . $row['transamount'] . "</td>";
        echo "<td>" . $row['transacct'] . "</td>";
        if($row['transstatus']=="Processing"){
        echo "<td><font color=\"red-orange\">" . $row['transstatus'] . "</font></td>";
        } else{
        echo "<td><font color=\"green\">" . $row['transstatus'] . "</font></td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>"; // Close the responsive table div

    // Free result set
    mysqli_free_result($result);
} else {
    echo "<br/>";
    echo "<h6>No Transaction Records Found</h6>";
    echo "<small>(Status of your recharge and payout will appear here.)</small>";
}
?>
