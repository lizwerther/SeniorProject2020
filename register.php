
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Log in to Listify</title>

    <!-- Bootstrap core CSS -->
<link href="signin.css" rel="stylesheet">
<div class="top">
  <div class="bar">
      <div class="top-left">
      <a href="example.html" class="bar-item button">
      <b>LIST</b>ify
      </a>
      </div>
  <!-- add css-->
      <div class="top-right">
          <a href=#Global class="bar-item button">Global</a>
          <a href=#Following class="bar-item button">Following</a>
          <a href=#Me class="bar-item button">Me</a>
          <a href="sign-in.html" class="bar-item button">Login</a>
      </div>
  </div>

</div>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    <link href="css.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form method="post" class="form-signin">
  <img class="mb-4" src="./ListifyLogo.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Register Here</h1>
  <label for="inputName" class="sr-only">First Name</label><br>
  <input type="fname" class="form-control" placeholder="First Name" name="fname"  required><br>
  <label for="inputName" class="sr-only">Last Name</label><br>
  <input type="lname" class="form-control" placeholder="Last Name" name="lname"  required><br>
  <label for="inputUsername" class="sr-only">Email</label><br>
  <input type="email"  class="form-control" placeholder="Email address" name="email" required><br>
  <label for="inputName" class="sr-only">Phone Number</label><br>
  <input type="number" class="form-control" placeholder="Phone Number" name="phonenumber"  required><br>
  <label for="inputName" class="sr-only">Username</label><br>
  <input type="username" class="form-control" placeholder="Username" name="username"  required><br>
  <label for="inputPassword" class="sr-only">Password</label>
  <br><input type="password" class="form-control" placeholder="Password" name= "password" autocomplete= "on" required>
      <br>
  <button type="submit" class="btn btn-lg btn-primary btn-block" name="submit">Submit</button>
  <!--<p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p> -->
  <div class="links">
  <a href="index.php">Already Have an Account? Log in Here</a>
  </div>

</form>
</body>
</html>

<?php
$UserID = 0; 
//$conn = mysqli_connect('localhost', 'listify', '', 'general');
$conn = oci_connect('asheerin', 'sP01397995', 'csdb2.csc.Villanova.edu:1521/orcl.villanova.edu');
require "conn.php"; 
if(!$conn){ 
   echo "connection fail";
}
// else {echo "connection success";}

if(isset($_POST["submit"])){ 
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"]; 
    $username = $_POST["username"]; 
    $password = $_POST["password"];

    $query = ("SELECT PROFILEID FROM PROFILES WHERE rownum = 1 ORDER BY PROFILEID DESC"); 
    $s = oci_parse($conn, $query);
    oci_execute($s);
    $row = oci_fetch_array($s, OCI_NUM);
    $UserID= $row[0];

    $UserID = $UserID + 1; 
  
    
    $sql = "INSERT INTO PROFILES (PROFILEID, fname, lname, email, phonenumber, username, pword) VALUES ('$UserID', '$fname', '$lname', '$email', '$phonenumber', '$username', '$password')";

    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
    if( !$res ){
        $error = oci_error($stmt);
        echo "Error: " . $error['message'] . "\n";
    }else{
      //  echo "OK\n";
    }


    //$query = "INSERT INTO PROFILES (PROFILEID, fname, email, pword) VALUES ('$username', '$name', '$email', '$password')"; 
    //echo $query;
   // $result = mysqli_query($conn,$query); 
    //echo $result; 
   
   // if($result){ 
     //   echo "your account has been created";
   // }
    //else { 
    //    echo "sorry, there is a problem";
   // }
}

?>