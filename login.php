<?php
require_once('config.php');
$username = $password="";
$username_err= $password_err='';

if($_SERVER["REQUEST_METHOD"] == "POST"){

      // Validate username
      $input_username = trim($_POST["username"]);
      if(empty($input_username)){
          $username_err = "Username should not be empty";
      }else{
          $username = $input_username;
      }

      // Validate password
      $input_password = trim($_POST["password"]);
      if(empty($input_password)){
          $password_err = "Password should not be empty";
      }else{
          $password = $input_password;
      }

      if(empty($username_err)){        
        // Attempt insert query execution
        $query= "SELECT * from account where username='$username' and password='$password'";
        $result=mysqli_query($link, $query)
        or die("Error in query: $query .". mysqli_error());
        $count=mysqli_num_rows($result);
        $numrows=$count;

        if($numrows<=0){

          $username_err="Invalid username";
          $password_err="Invalid password";
        }
        
        else{
        // Fetch the account details
        $row = mysqli_fetch_assoc($result);
       
        // Store account details in session
        
        $_SESSION['userId'] = $row['userId'];
        $_SESSION['accounttype'] = $row['account-type'];
        $_SESSION['fname'] = $row['fname'];        
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['username'] = $row['username'];  
        $_SESSION['loggedin']= true;
        
          
        // Redirect to home page
        echo "<script>window.location.href='index.php?page=home'</script>";
        exit();
        }
        
        // Close connection
        mysqli_close($link);               
        
    }
    }
?>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header">
                      <br>
                        <h2>Room Sense</h2>
                    </div>
                    <p>Please enter your login credentials.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?page=login" method="post">



                        <div class="form-group">
                            <label>Username</label>                           
                            <input type="text" name="username" class="form-control" placeholder="Enter username" >
                            <span class="help-block text-danger"><?php echo $username_err ?></span>
                        </div>

                        <div class="form-group ">
                            <label>Password</label>                           
                            <input type="password" name="password" class="form-control" placeholder="Enter password" >
                            <span class="help-block text-danger"><?php echo $password_err ?></span>
                        </div>

                               
                        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Login">
                        <a href="index.php?page=home" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>


