<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$refnum = $transtype = $transamount = $acctnum = $status = "";
$transtype_err = $transamount_err = $acctnum_err = "";
$userId = $_SESSION['userId'];

// Get balance
$sqlbal = "SELECT `task-rewards` FROM account WHERE userId='$userId'";
$result = mysqli_query($link, $sqlbal);
$row = mysqli_fetch_array($result);
$walletbalance = $row['task-rewards'];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if transaction number is unique
    $input_genId = trim($_POST["genId"]);
    $sql1 = "SELECT * FROM mytransaction WHERE refnum='$input_genId'";
    $checkId = mysqli_query($link, $sql1);

    if(empty($input_genId)){
        $genId_err = "Please enter your transaction number.";
    } else if(mysqli_num_rows($checkId) > 0){
        $input_genId = generateRefNum();
        $genId = $input_genId;
    } else {
        $genId = $input_genId;
    }

    // Validate amount
    $input_transamount = trim($_POST["transamount"]);
    $input_transtype = trim($_POST["transtype"]);
    if(empty($input_transamount)){
        $transamount_err = "Please enter amount.";
    } else if(!is_numeric($input_transamount) || $input_transamount <= 0){
        $transamount_err = "Please enter a valid amount.";
    } else if($input_transtype == "Cashout" && $input_transamount < 100){
        $transamount_err = "Cashout amount should not be less than 100.";
    } else if($input_transtype == "Cashout" && $input_transamount > $walletbalance){
        $transamount_err = "Cashout amount should not be greater than wallet balance.";
    } else {
        $transamount = $input_transamount;
    }

    // Validate transtype
    if(empty($input_transtype)){
        $transtype_err = "Please select Transaction type.";
    } else {
        $transtype = $input_transtype;
    }

    // Validate acctnum
    $input_acctnum = trim($_POST["acctnum"]);
    if($input_transtype == "Cashout" && empty($input_acctnum)){
        $acctnum_err = "Please enter your GCash number.";
    } else {
        $acctnum = $input_acctnum;
    }

    // Check input errors before inserting in database
    if(empty($genId_err) && empty($transtype_err) && empty($transamount_err) && empty($acctnum_err)){
        // Attempt insert query execution
        $currentDateTime = date('Y-m-d H:i:s');

        if ($transtype == "Cashout") {
            $updatedbalance = $walletbalance - $transamount;
            $query2 = "UPDATE `account` SET `task-rewards`= '$updatedbalance' WHERE `userId`= '$userId'";
            mysqli_query($link, $query2) or die("Error in query: $query2." . mysqli_error($link));
        }

        

        $sql2 = "INSERT INTO mytransaction (refnum, userId, transtype, transamount, transacct, transstatus, transdate) VALUES ('$genId', '$userId', '$transtype', '$transamount', '$acctnum', 'Processing', '$currentDateTime')";
        if(mysqli_query($link, $sql2)){
            echo "<script>
                alert('Transaction is Created Successfully');
                window.location.href='index.php?page=requestCashout';
                </script>";
            exit();
        } else {
            echo "ERROR: Could not execute $sql2. " . mysqli_error($link);
        }

        // Close connection
        mysqli_close($link);
    }
}

// Generate a reference number
function generateRefNum($length = 12) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($chars);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $chars[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="page-header">
                    <br><div class="d-flex justify-content-end">
                    <strong>QWallet Balance: &nbsp; </strong><span id="wallet-balance"></span>
                   
                </div>
                <div  class="d-flex justify-content-end">
                <a href="index.php?page=myTransactions" class="text-primary">View Previous Transactions</a>
                </div> <br>
                
                    
                    <h2>Transaction Requests</h2>
                    <p>Please double check data before submitting.</p><br>
                </div>
                
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?page=requestCashout" method="post">
                    <input type="hidden" name="genId" class="form-control" value="<?php echo generateRefNum(); ?>">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" placeholder="Amount" name="transamount" id="transamount" onchange="checkValue(this.value)" value="<?php echo $transamount; ?>" aria-label="Amount">
                                <span class="help-block text-danger"><?php echo $transamount_err;?></span>
                            </div>
                            <div class="col">                                      
                                <select class="form-select form-control" aria-label="Default select example" name="transtype" id="transtype" onchange="showGcashField(this.value)">
                                    <option selected>Select Transaction Type</option>
                                    <option value="Recharge">Recharge</option>
                                    <option value="Cashout">Cashout</option>
                                </select>
                                <span class="help-block text-danger"><?php echo $transtype_err;?></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    $sqlgcash = "SELECT gcash FROM account WHERE userId='$userId'";
                    $result1 = mysqli_query($link, $sqlgcash);
                    $row = mysqli_fetch_array($result1);
                    $initacctnum = $row['gcash'];
                    ?>

                    <div id="gcashField" class="form-group <?php echo (!empty($acctnum_err)) ? 'has-error' : ''; ?>" style="display:none;">
                        <label>Gcash Account Number</label>                           
                        <input type="text" name="acctnum" class="form-control" value="<?php echo $initacctnum; ?>">
                        <span class="help-block text-danger"><?php echo $acctnum_err;?></span>
                    </div>
                    
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>        
    </div>
</div>

<script>

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



function showGcashField(value) {
    let balance = parseFloat(document.getElementById('wallet-balance').innerText);
    let transamount_err = "";
    let transamount = parseFloat(document.getElementById('transamount').value);

    if (value == "Cashout") {
        document.getElementById('gcashField').style.display = 'block';

        if(transamount > balance){
            transamount_err = "Cashout amount should not be greater than wallet balance.";
            }  
        }else {
        document.getElementById('gcashField').style.display = 'none';
    }
}

function checkValue(value) {
    let balance = parseFloat(document.getElementById('wallet-balance').innerText);
    let transamount_err = "";
    let transtype = document.getElementById('transtype').value;

    if (value < 100 ) {
        transamount_err = "Amount should not be less than 100.";
    } else if (value > balance && transtype == "Cashout") {
        transamount_err = "Cashout amount should not be greater than wallet balance.";
    }
    document.querySelector('.help-block.text-danger').innerText = transamount_err;
}
</script>
