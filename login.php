<?php
session_start(); 
require "conn.php"; 
$conn = oci_connect('asheerin', 'sP01397995', 'csdb2.csc.Villanova.edu:1521/orcl.villanova.edu');
if(isset($_POST["submit"])){ 
    $email = $_POST["email"]; 
    $password = $_POST["password"]; 
    $query = "SELECT * FROM PROFILES WHERE email='$email'";
    $s = oci_parse($conn, $query);
    oci_execute($s);
    $numrows= oci_num_fields($s);
    //echo $numrows;
    if(($row = oci_fetch_row($s)) == false) { 
        header("Location:index.php?msg2");
    }
    else{ 
       // echo "hi";
       // while(($row = oci_fetch_row($s)) != false){ 
           // $id = $row["id"]; 
           //echo "hey";
           //echo $row[0];
            $db_password = $row[6]; 
            $db_email = $row[3]; 
          //  echo $db_email;
            if($email == $db_email && $password == $db_password){ 
                $_SESSION["USER"] = $email; 
                header("Location: me.php");
                echo "You are in!!";
                exit;
            }
            else{ header("Location:index.php?msg");}
        }
    }

