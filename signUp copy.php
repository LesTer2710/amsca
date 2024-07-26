<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$firstName = $lastName = $username = $password = $confirm_password = "";
$firstName_err = $lastName_err = $username_err = $password_err = $confirm_password_err = "";

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
        $firstName_err = "Please enter your first name.";
    } else {
        $firstName = $input_firstName;
    }

    // Validate lastName
    $input_lastName = trim($_POST["lastName"]);
    if(empty($input_lastName)){
        $lastName_err = "Please enter your last name.";
    } else {
        $lastName = $input_lastName;
    }

    // Validate username
    $input_username = trim($_POST["username"]);
    $sql = "SELECT * FROM account WHERE username='$input_username'";
    $checkusername = mysqli_query($link, $sql);

    if(empty($input_username)){
        $username_err = "Please enter a username.";
    } else if(mysqli_num_rows($checkusername) > 0){
        $username_err = "Username is already taken.";
    } else {
        $username = $input_username;
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter a password.";
    } else {
        $password = $input_password;
    }

    // Validate confirm password
    $input_confirm_password = trim($_POST["confirm_password"]);
    if(empty($input_confirm_password)){
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = $input_confirm_password;
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($firstName_err) && empty($lastName_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        // Attempt insert query execution
        $sql2 = "INSERT INTO account (userId, fname, lname, username, password) VALUES ('$genId', '$firstName', '$lastName', '$username', '$password')";
        if(mysqli_query($link, $sql2)){
            // Records created successfully. Redirect to login page
            $message = "Your account is successfully created. You may now login to the system.";
            $alertType = "success";
            // echo "<script>
            //     alert('Account Created Successfully');
            //     window.location.href='index.php?page=login';
            //     </script>";
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
    $numbers = range(1, 100);
    shuffle($numbers);
    $genId = "$numbers[0]$numbers[8]$numbers[1]$numbers[2]$numbers[5]$numbers[9]";
    return $genId;   
}
?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="page-header">
                    <br>
                    <h2>Sign Up</h2>
                </div>
                <p>Please fill out and submit to create your account.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?page=signup" method="post">
                    <input type="hidden" name="genId" class="form-control" value="<?php echo generateId(); ?>">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First name" name="firstName" value="<?php echo $firstName; ?>" aria-label="First name">
                                <span class="help-block text-danger"><?php echo $firstName_err;?></span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Last name" name="lastName" value="<?php echo $lastName; ?>" aria-label="Last name">
                                <span class="help-block text-danger"><?php echo $lastName_err;?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Desired Username</label>                           
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block text-danger"><?php echo $username_err;?></span>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>                           
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="help-block text-danger"><?php echo $password_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>                           
                        <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                        <span class="help-block text-danger"><?php echo $confirm_password_err;?></span>
                    </div>
                    
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>        
    </div>
</div>
