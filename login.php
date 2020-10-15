<?php
session_start(); 
require "conn.php"; 
if(isset($_POST["submit"])){ 
    $email = $_POST["email"]; 
    //echo $email;
    $password = $_POST["password"]; 
    $query = "SELECT * FROM login WHERE email='$email'";
    $result = mysqli_query($conn, $query); 
    $numrows = mysqli_num_rows($result); 
  //  echo $numrows;

    if($numrows != 0){ 
        while($row = mysqli_fetch_assoc($result)){ 
           // $id = $row["id"]; 
            $db_password = $row["password"]; 
            $db_email = $row["email"]; 
            if($email == $db_email && $password == $db_password){ 
                $_SESSION["USER"] = $email; 
                header("Location: me.php");
                exit;
            }
            else{ echo "Sorry, your password is incorrect";}
        }
    }
    else { "User doesnt exist";}
}