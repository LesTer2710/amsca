<?php 
// Include config file
require_once "config.php";
        
        $sql = "SELECT * FROM student ORDER BY lastName ASC";         
        $result = mysqli_query($link,$sql); 
        
        if(mysqli_num_rows($result) > 0){
                   
        //count result        
        echo "There are <b>" .mysqli_num_rows($result). "</b> results found";
      
            echo "<table class='table table-bordered'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>First Name</th>";
                                        echo "<th>Last Name</th>";
                                        echo "<th>Contact Number</th>";                                        
                                        echo "<th>Action</th>";     
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";                                        
                                        echo "<td>" . $row['firstName'] . "</td>";                              
                                        echo "<td>" . $row['lastName'] . "</td>";
                                        echo "<td>" . $row['contactNumber'] . "";                                         
                                        echo "<td>";
                                        
                                        echo "<a href='index.php?page=updateStudent&id=". $row['studentId'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'> Edit</span></a>";                                        
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                                                  
        }else{
            echo "<h3>No Records Found</h3>";
        }
?>