<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$userId= $username= $accounttype="";

$userId_err= $username_err= $accounttype_err="";

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


       // Validate accountype
     $input_accountype = trim($_POST["accounttype"]);
     if(empty($input_accountype)){
         $accountype_err = "Please enter accountype.";
     }else{
         $accounttype = $input_accountype;
     }

 // Attempt update query execution
 $sql2 = "UPDATE account SET `account-type`='".$accounttype."'
 WHERE userId = '".$userId."'";

 if(mysqli_query($link, $sql2)){
 // Records created successfully. Redirect to landing page
 echo "<script>
 alert('Account Successfully Activated');
 window.location.href='index.php?page=activateUsers';
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
        $accounttype=$row['account-type'];
    }
?>
 

            <div class="row">
                <div class="col-md-12">
                    <div class="page-header"><br>
                        <h2>Activate Account</h2>
                    </div>
                    <p>Please enter the User ID you want to activate.</p>
                   
                    <form class="form-floating" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        
                    <div class="form-group"> 
                        <label for="userId">User ID</label>                            
                            <input type="text" readnly name="userId" id="userId" class="form-control" value="<?php echo $userId; ?>">                           
                        </div>

                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <div class="row">
                        <div class="col">
                        
                            <label>Username</label>                           
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>   
                        <div class="col">            
                            <label>Account Type</label>                           
                            <select class="form-select form-control" aria-label="Default select example" name="accounttype">
                                <option selected value="<?php echo $accounttype; ?>"><?php echo $accounttype; ?></option>
                                <option value="Basic">Basic</option>
                                <option value="Bronze">Bronze</option>
                                <option value="Silver">Silver</option>
                                <option value="Gold">Gold</option>
                                <option value="Admin">Admin</option>
                               <option value="Not Activated">Not Activated</option>
                            </select>
                            <span class="help-block"><?php echo $accounttype_err;?></span>
                            </div>
                            </div>
                        </div>

                        
                        <input type="submit" class="btn btn-primary" value="Activate User">
                        <a href="index.php" class="btn btn-default">Cancel</a>

                        
                    </form>
                </div>
            </div>        


<?php     }


?>