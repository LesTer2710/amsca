<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$current_password = $new_password = $confirm_password = "";
$current_password_err = $new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate current password
    $input_current_password = trim($_POST["current_password"]);
    if (empty($input_current_password)) {
        $current_password_err = "Please enter the current password.";
    } else {
        $current_password = $input_current_password;
    }

    // Validate new password
    $input_new_password = trim($_POST["new_password"]);
    if (empty($input_new_password)) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen($input_new_password) < 6) {
        $new_password_err = "Password must have at least 6 characters.";
    } else {
        $new_password = $input_new_password;
    }

    // Validate confirm password
    $input_confirm_password = trim($_POST["confirm_password"]);
    if (empty($input_confirm_password)) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = $input_confirm_password;
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($current_password_err) && empty($new_password_err) && empty($confirm_password_err)) {
        // Validate current password
        $id = $_SESSION["userId"];
        $sql = "SELECT password FROM account WHERE userId='$id'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($current_password == $row["password"]) {
                // Update password
                $sql2 = "UPDATE account SET password='$new_password' WHERE userId='$id'";
                if (mysqli_query($link, $sql2)) {
                    echo "<script>
                        alert('Your password has been successfully updated');
                        window.location.href='index.php?page=myAccount';
                        </script>";
                    exit();
                } else {
                    echo "ERROR: Could not execute $sql2. " . mysqli_error($link);
                }
            } else {
                $current_password_err = "The current password is not correct.";
            }
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($link);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header"><br>
            <h2>Change Password</h2>
        </div>
        <p>Please fill out this form to change your password.</p>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

            <div class="form-group <?php echo (!empty($current_password_err)) ? 'has-error' : ''; ?>">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control" value="<?php echo $current_password; ?>">
                <span class="help-block"><?php echo $current_password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php?page=myAccount" class="btn btn-default">Cancel</a>
        </form>
    </div>
</div>
