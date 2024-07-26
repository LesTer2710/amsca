<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$firstName = $lastName = $cpNumber ="";
$firstName_err  = $lastName_err = $cpNumber_err = "";

// Processing form data when form is submitted
if(isset($_POST["studentId"]) && !empty($_POST["studentId"])){
   // Get hidden input value
   $studentId = $_POST["studentId"];

    // Validate firstName
    $input_firstName = trim($_POST["firstName"]);
    if(empty($input_firstName)){
        $firstName_err = "Please enter a first name.";
    }else{
        $firstName = $input_firstName;
    }

    // Validate lastName
    $input_lastName = trim($_POST["lastName"]);
    if(empty($input_lastName)){
        $lastName_err = "Please enter a last name.";
    }else{
        $lastName = $input_lastName;
    }

     // Validate CP Number
     $input_cpNumber = trim($_POST["cpNumber"]);
     if(empty($input_cpNumber)){
         $cpNumber_err = "Please enter cellphone Number.";
     }else{
         $contactNumber = $input_cpNumber;
     }

 // Attempt update query execution
 $sql2 = "UPDATE student SET studentId='".$studentId."', firstName='".$firstName."', lastname='".$lastName."', contactNumber='".$contactNumber."' WHERE studentId = '".$studentId."'";
 if(mysqli_query($link, $sql2)){
 // Records created successfully. Redirect to landing page
 echo "<script>
 alert('Student Successfully Updated');
 window.location.href='index.php';
 </script>";             
 exit();
 } else{
 echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
 }
 
 // Close connection
 mysqli_close($link);               
 
 


}






$id = $_GET["id"];

$sql = "SELECT * FROM student where studentId = '".$id."'";         
$result = mysqli_query($link,$sql); 


if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $studentId = $row['studentId'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $contactNumber = $row['contactNumber'];

?>
 

            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        
                    <div class="form-group">                            
                            <input type="hidden" name="studentId" class="form-control" value="<?php echo $studentId; ?>">                           
                        </div>

                        <div class="form-group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
                            <label>First Name</label>                           
                            <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>">
                            <span class="help-block"><?php echo $firstName_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>                           
                            <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>">
                            <span class="help-block"><?php echo $lastName_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($cpNumber_err)) ? 'has-error' : ''; ?>">
                            <label>Cellphone Number</label>                           
                            <input type="text" name="cpNumber" class="form-control" value="<?php echo $contactNumber; ?>">
                            <span class="help-block"><?php echo $cpNumber_err;?></span>
                        </div>
                        
                        <input type="hidden" name="thesisID" class="form-control" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>

                        
                    </form>
                </div>
            </div>        


<?php     }

}
?>