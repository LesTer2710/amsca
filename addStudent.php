<?php

// Include config file
require_once "config.php";


// Define variables and initialize with empty values
$firstName = $lastName = $cpNumber ="";
$firstName_err  = $lastName_err = $cpNumber_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate studentId
    $input_studentId = trim($_POST["studentId"]);
    if(empty($input_studentId)){
        $studentId_err = "Please enter a student ID.";
    }else{
        $studentId = $input_studentId;
    }

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
             $cpNumber = $input_cpNumber;
         }
 

   

        if(empty($firstName_err)){        
                // Attempt insert query execution
                $sql2 = "INSERT INTO student (studentId, firstName, lastName, contactumber) VALUES ( '".$studentId."','".$firstName."', '".$lastName."', '".$cpNumber."' )";
                if(mysqli_query($link, $sql2)){
                echo "Records inserted successfully.";
                } else{
                echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
                }
                
                // Close connection
                mysqli_close($link);               
                
                

                // Records created successfully. Redirect to landing page
                echo "<script>
                alert('Student Successfully Added');
                window.location.href='index.php';
                </script>";             
                exit();
            }
            }
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header">
                        <h2>Create Student Record</h2>
                    </div>
                    <p>Please fill this form and submit to add thesis record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?page=addStudent" method="post">

                    <?php 
                            //shuffle number
                            $numbers = range(1, 100);
                            shuffle($numbers);

                            $studentId = "$numbers[0]$numbers[9] ";
                        ?>

                        <div class="form-group">                            
                            <input type="hidden" name="studentId" class="form-control" value="<?php echo "studentId".$studentId; ?>">                           
                        </div>

                        <div class="form-group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
                            <label>First Name</label>                           
                            <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>" >
                            <span class="help-block"><?php echo $firstName_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>                           
                            <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>" >
                            <span class="help-block"><?php echo $lastName_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($cpNumber_err)) ? 'has-error' : ''; ?>">
                            <label>Cellphone Number</label>                           
                            <input type="text" name="cpNumber" class="form-control" value="<?php echo $cpNumber; ?>" >
                            <span class="help-block"><?php echo $cpNumber_err;?></span>
                        </div>
                        
                        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>


