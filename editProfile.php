<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$userId=$fname= $lname= "";

$userId_err= $fname_err= $lname_err= "";

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

    

       

    



 // Attempt update query execution
 $sql2 = "UPDATE account SET userId='".$userId."', fname='".$fname."' , lname='".$lname."'
 WHERE userId = '".$userId."'";

 if(mysqli_query($link, $sql2)){
 // Records created successfully. Redirect to landing page


 echo "<script>
 alert('Your Profile is Successfully Updated');
 window.location.href='index.php?page=myAccount';
 </script>";             
 exit();
 } else{
 echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
 }
 
 // Close connection
 mysqli_close($link);               
 
 


}






$id = $_SESSION["userId"];

$sql = "SELECT * FROM account where userId = '".$id."'";         
$result = mysqli_query($link,$sql); 


if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $userId = $row['userId'];
        $fname=$row['fname'];
        $lname=$row['lname'];
       
        



?>
 

            <div class="row">
                <div class="col-md-12">
                    <div class="page-header"><br>
                        <h2>Edit Profile</h2>
                    </div>
                    <p>Please edit and submit to update your account.</p>
                   
                    <form class="form-floating" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        
                    <div class="form-group"> 
                        <label for="userId">User ID</label>                            
                            <input readonly name="userId" id="userId" class="form-control" value="<?php echo $userId; ?>">                           
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

                       

                                                
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php?page=myAccount" class="btn btn-default">Cancel</a>

                        
                    </form>
                </div>
            </div>        


<?php     }

}
?>