<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$userId= $username= $password= 
$fname= $lname= $gcash= $accounttype=$activaticredits= 
$taskpoints=$referralbonus= $totalbalance="";

$userId_err= $username_err= $password_err= 
$fname_err= $lname_err= $gcash_err= $accounttype_err=
$activationcredits_err= $taskpoints_err=$referralbonus_err= $totalbalance_err="";

// Processing form data when form is submitted
if(isset($_POST["userId"]) && !empty($_POST["userId"])){
   // Get hidden input value
   $userId = $_POST["userId"];

    // Validate userId
    $input_userId = trim($_POST["userId"]);
    if(empty($input_userId)){
        $userId_err = "Please enter a user ID.";
    }else{
        $userId = $input_userId;
    }

    // Validate username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Please enter a username.";
    }else{
        $username = $input_username;
    }

     // Validate password
     $input_password = trim($_POST["password"]);
     if(empty($input_password)){
         $password_err = "Please enter password.";
     }else{
         $password = $input_password;
     }

      // Validate fname
      $input_fname = trim($_POST["fname"]);
      if(empty($input_fname)){
          $fname_err = "Please enter fname.";
      }else{
          $fname = $input_fname;
      }

       // Validate lname
     $input_lname = trim($_POST["lname"]);
     if(empty($input_lname)){
         $lname_err = "Please enter lname.";
     }else{
         $lname = $input_lname;
     }

      // Validate gcash
      $input_gcash = trim($_POST["gcash"]);
      if(empty($input_gcash)){
          $gcash_err = "Please enter gcash.";
      }else{
          $gcash = $input_gcash;
      }

       // Validate accountype
     $input_accountype = trim($_POST["accounttype"]);
     if(empty($input_accountype)){
         $accountype_err = "Please enter accountype.";
     }else{
         $accounttype = $input_accountype;
     }

     // Validate activationcredits
     $input_activationcredits = trim($_POST["activationcredits"]);
     if(empty($input_activationcredits)){
         $activationcredits_err = "Please enter activationcredits.";
     }else{
         $activationcredits = $input_activationcredits;
     }

     // Validate taskrewards
     $input_taskrewards = trim($_POST["taskrewards"]);
     if(empty($input_taskrewards)){
         $taskrewards_err = "Please enter taskrewards.";
     }else{
         $taskrewards = $input_taskrewards;
     }

     // Validate referralbonus
     $input_referralbonus = trim($_POST["referralbonus"]);
     if(empty($input_referralbonus)){
         $referralbonus_err = "Please enter referralbonus.";
     }else{
         $referralbonus = $input_referralbonus;
     }

     // Validate totalbalance
     $input_totalbalance = trim($_POST["totalbalance"]);
     if(empty($input_totalbalance)){
         $totalbalance_err = "Please enter totalbalance.";
     }else{
         $ctotalbalance = $input_totalbalance;
     }



 // Attempt update query execution
 $sql2 = "UPDATE account SET userId='".$userId."', username='".$username."', password='".$password."', fname='".$fname."' , lname='".$lname."', gcash='".$gcash."', `account-type`='".$accounttype."', `activation-credits`='".$activationcredits."', `task-rewards`='".$taskrewards."', `referral-bonus`='".$referralbonus."', `total-balance`='".$totalbalance."'
 WHERE userId = '".$userId."'";

 if(mysqli_query($link, $sql2)){
 // Records created successfully. Redirect to landing page
 echo "<script>
 alert('Account Successfully Updated');
 window.location.href='index.php?page=viewUsers';
 </script>";             
 exit();
 } else{
 echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
 }
 
 // Close connection
 mysqli_close($link);               
 
 


}






$id = $_GET["id"];

$sql = "SELECT * FROM account where userId = '".$id."'";         
$result = mysqli_query($link,$sql); 


if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $userId = $row['userId'];
        $username = $row['username'];
        $password=$row['password'];
        $fname=$row['fname'];
        $lname=$row['lname'];
        $gcash=$row['gcash'];
        $accounttype=$row['account-type'];
        $activationcredits=$row['activation-credits'];
        $taskrewards=$row['task-rewards'];
        $referralbonus=$row['referral-bonus'];
        $totalbalance=$row['total-balance'];



?>
 

            <div class="row">
                <div class="col-md-12">
                    <div class="page-header"><br>
                        <h2>Update Account</h2>
                    </div>
                    <p>Please edit the input values and submit to update the account.</p>
                   
                    <form class="form-floating" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        
                    <div class="form-group"> 
                        <label for="userId">User ID</label>                            
                            <input name="userId" id="userId" class="form-control" value="<?php echo $userId; ?>">                           
                        </div>

                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <div class="row">
                        <div class="col">
                        
                            <label>Username</label>                           
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>

                        <div class="col <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>                           
                            <input type="text" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err;?></span>
                        
                        </div>
                        </div>
                        </div>

                        <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                           
                        <div class="row">
                        <div class="col">

                            <label>First Name</label>                           
                            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                            <span class="help-block"><?php echo $fname_err;?></span>
                        </div>

                        <div class="col <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>                           
                            <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
                            <span class="help-block"><?php echo $lname_err;?></span>
                        </div>
                        </div>
                        </div>

                        <div class="form-group <?php echo (!empty($gcash_err)) ? 'has-error' : ''; ?>">
                            <label>Gcash</label>                           
                            <input type="text" name="gcash" class="form-control" value="<?php echo $gcash; ?>">
                            <span class="help-block"><?php echo $gcash_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($accounttype_err)) ? 'has-error' : ''; ?>">
                        <div class="row">
                        <div class="col">
                            
                            <label>Account Type</label>                           
                            <select class="form-select form-control" aria-label="Default select example" name="accounttype">
                                <option selected value="<?php echo $accounttype; ?>"><?php echo $accounttype; ?></option>
                                <option value="Basic">Basic</option>
                                <option value="Bronze">Bronze</option>
                                <option value="Silver">Silver</option>
                                <option value="Gold">Gold</option>
                                <option value="Admin">Admin</option>
                            </select>
                            <span class="help-block"><?php echo $accounttype_err;?></span>
                        </div>

                        <div class="col <?php echo (!empty($activationcredits_err)) ? 'has-error' : ''; ?>">
                            <label>Activation Credits</label>                           
                            <input type="text" name="activationcredits" class="form-control" value="<?php echo $activationcredits; ?>">
                            <span class="help-block"><?php echo $activationcredits_err;?></span>
                        </div>
                        </div>
                        </div>

                        <div class="form-group <?php echo (!empty($taskrewards_err)) ? 'has-error' : ''; ?>">
                            <label>Wallet Balance</label>                           
                            <input type="text" name="taskrewards" class="form-control" value="<?php echo $taskrewards; ?>">
                            <span class="help-block"><?php echo $taskpoints_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($referralbonus_err)) ? 'has-error' : ''; ?>">
                            <label>Referral Bonus</label>                           
                            <input type="text" name="referralbonus" class="form-control" value="<?php echo $referralbonus; ?>">
                            <span class="help-block"><?php echo $referralbonus_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($totalbalance_err)) ? 'has-error' : ''; ?>">
                            <label>Total Balance</label>                           
                            <input readonly type="text" name="totalbalance" class="form-control" value="<?php echo $totalbalance; ?>">
                            <span class="help-block"><?php echo $totalbalance_err;?></span>
                        </div>

                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php?page=viewUsers" class="btn btn-default">Cancel</a>

                        
                    </form>
                </div>
            </div>        


<?php     }

}
?>