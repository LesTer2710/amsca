<?php
require_once "config.php";

session_start(); // Start the session

$username=$_POST['username'];
$password=$_POST['password'];


$query= "SELECT * from account where username='$username' and password='$password'";
$result=mysqli_query($link, $query)
or die("Error in query: $query .". mysqli_error());
$count=mysqli_num_rows($result);
$numrows=$count;

if($numrows<=0){
    echo "<script>
        alert('Invalid username or password');
    </script>";
    header("Location: index.php");
    
    
    
} else {
   // Fetch the account details
   $row = mysqli_fetch_assoc($result);

   // Store account details in session
   
   $_SESSION['userId'] = $row['userId'];
     
   // Redirect to home page
   header("Location: index.php?page=Qaptcha");
   exit();
}
mysqli_close($link);

?>