<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$firstName = $lastName = $username = $password = $accounttype = "";
$firstName_err = $lastName_err = $username_err = $password_err = $accounttype_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate genId
    $input_genId = trim($_POST["genId"]);
    $sql1 = "SELECT * FROM account WHERE userId='$input_genId'";
    $checkId = mysqli_query($link, $sql1);

    if(empty($input_genId)){
        $genId_err = "Please enter your user ID.";
    } else if(mysqli_num_rows($checkId) > 0){
        $input_genId = generateId();
        $genId = $input_genId;
    } else {
        $genId = $input_genId;
    }

    // Validate firstName
    $input_firstName = trim($_POST["firstName"]);
    if(empty($input_firstName)){
        $firstName_err = "Please enter user's first name.";
    } else {
        $firstName = $input_firstName;
    }

    // Validate lastName
    $input_lastName = trim($_POST["lastName"]);
    if(empty($input_lastName)){
        $lastName_err = "Please enter user's last name.";
    } else {
        $lastName = $input_lastName;
    }

    // Validate username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Please enter a username.";
    } else {
        $username = $input_username;
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please set a password.";
    } else {
        $password = $input_password;
    }

    // Validate confirm password
    $input_accounttype = trim($_POST["accounttype"]);
    if(empty($input_accounttype)){
        $accounttype_err = "Please select user's role.";
    } else {
        $accounttype = $input_accounttype;
       
    }

    // Check input errors before inserting in database
    if(empty($firstName_err) && empty($lastName_err) && empty($username_err) && empty($password_err) && empty($accounttype_err)){
        // Attempt insert query execution
        $sql2 = "INSERT INTO account (userId, fname, lname, username, password, `account-type`) VALUES ('$genId', '$firstName', '$lastName', '$username', '$password', '$accounttype')";
        if(mysqli_query($link, $sql2)){
            // Records created successfully. Redirect to login page
            // $message = "User with ID No. ".$genId." is created successfully.";
            // $alertType = "success";
            echo "<script>
                alert('Account Created Successfully');
                window.location.href='index.php?page=addUsers';
                </script>";
            exit();
        } else {
            echo "ERROR: Could not execute $sql2. " . mysqli_error($link);
        }
        
        // Close connection
        mysqli_close($link);
    }

  
}

// echo "<div class='alert alert-$alertType alert-dismissible fade show' role='alert'>
// $message
// <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//     <span aria-hidden='true'>&times;</span>
// </button>
// </div>
// <script>
// setTimeout(function() {
//     window.location.href = 'index.php?page=viewUsers';
// }, 1500);
// </script>";



// Generate a random user ID
function generateId(){
    $numbers = range(10,99);
    shuffle($numbers);
    
    $genId = "RS-"."$numbers[0]$numbers[8]";
    return $genId;   
}
?>

<script>
   

    function generateCred(){
        let password=document.getElementById('lastname').value;
        let defpassword= password.toUpperCase();
        document.getElementById('password').value=defpassword;

        let defusername=document.getElementById('genId').value;
        document.getElementById('username').value=defusername;
    }
    
    
</script>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="page-header">
                    <br>
                    <h2>Add New Users</h2>
                </div>
                <p>Please fill out and submit to add new users.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?page=addUsers" method="post">
                    <input type="hidden" id="genId" name="genId" class="form-control" value="<?php echo generateId(); ?>">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First name" name="firstName" value="<?php echo $firstName; ?>" aria-label="First name">
                                <span class="help-block text-danger"><?php echo $firstName_err;?></span>
                            </div>
                            <div class="col">
                                <input oninput="generateCred()" id="lastname" type="text" class="form-control" placeholder="Last name" name="lastName" value="<?php echo $lastName; ?>" aria-label="Last name">
                                <span class="help-block text-danger"><?php echo $lastName_err;?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="cred">
                        <div class="row">
                            <div class="col">
                                <label>Username</label>                           
                                <input readonly type="text" id="username" name="username" class="form-control" >
                                <span class="help-block text-danger"><?php echo $username_err;?></span>
                            </div>
                            <div class="col">
                                <label>Password</label>                           
                                <input readonly type="text" id="password" name="password" class="form-control" >
                                <span class="help-block text-danger"><?php echo $password_err;?></span>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Role</label>  <br>                         
                        <select class="form-select form-control" aria-label="Default select example" name="accounttype">
                                <option value="Faculty">Faculty</option>
                                <option value="Admin">System Admin</option>
                        </select> 
                        <span class="help-block text-danger"><?php echo $accounttype_err;?></span>
                    </div><br><br>

                    
                    
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>        
    </div>
</div>
