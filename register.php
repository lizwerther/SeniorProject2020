<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Listify</title>

    <!-- Bootstrap core CSS -->
<link href="signin.css" rel="stylesheet">
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
    <!-- <link href="css.css" rel="stylesheet"> -->
  </head>
  <body class="text-center">
    <form method="post" class="form-signin">
    <img class="mb-4" src="./listify 1 white.png" alt="" width="204" height="77">
<br>
    <span style="color:red" > <?php
if(isset($_GET['msgusername']))
{
    $Message = "An Account with that Username already exists";
    print $Message;
}
if(isset($_GET['msgemail']))
{
    $Message = "An account with that Email already exists";
    print $Message;
}
?></span>

  <div class="main" >

  <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
  <div class="register">
  <label for="inputName" class="sr-only">First Name</label><br>
  <input type="fname" class="form-control" placeholder="First Name" name="fname"  required><br>
  <label for="inputName" class="sr-only">Last Name</label><br>
  <input type="lname" class="form-control" placeholder="Last Name" name="lname"  required><br>
  <label for="inputUsername" class="sr-only">Email</label><br>
  <input type="email"  class="form-control" placeholder="Email address" name="email" required><br>
<!-- <label for="inputName" class="sr-only">Phone Number</label><br> 
  <input type="number" class="form-control" placeholder="Phone Number" name="phonenumber"  required><br> -->
  <label for="inputName" class="sr-only">Username</label><br>
  <input type="username" class="form-control" placeholder="Username" name="username"  required><br>
  <label for="inputPassword" class="sr-only">Password</label>
  <br><input type="password" class="form-control" placeholder="Password" name= "password" autocomplete= "on" required><br>
  <label for="inputBio" class="sr-only">Bio</label>
  <br><input type="bio" class="form-control" placeholder="Tell Us About Yourself!" name= "bio" required>
  </div>
  <!--<input name="interests" for ="inputInterests" > -->
  <p>Please select all of your interests!</p>
    <div class="interests">
    Movies: <input type="checkbox" name="interests[]" value="Movies"  /><br />
    TV Shows: <input type="checkbox" name="interests[]" value="Tv Shows"  /><br /> 
    Podcasts: <input type="checkbox" name="interests[]" value="Podcasts"  /><br /> 
    Books: <input type="checkbox" name="interests[]" value="Books"  /><br />
    Food: <input type="checkbox" name="interests[]" value="Food"  /><br /> 
    Fashion: <input type="checkbox" name="interests[]" value="Fashion"  /><br /> 
    Games: <input type="checkbox" name="interests[]" value="Games"  /><br /> 
    </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block" name="submit">Sign Up</button>
  <!--<p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p> -->
  <div class="links">
  <a href="index.php">Already have an account? Log in</a>
  </div>
</div>
</form>
</body>
</html>

<?php
//$UserID = 0; 
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
    $username = $_POST["username"]; 
    $password = $_POST["password"];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $bio = $_POST["bio"];
   if(in_array('Movies', $_POST['interests'])){
        $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'Movies')";
        $stmt = oci_parse($conn, $sql);
        $res = oci_execute($stmt);
    }
    if(in_array('Tv Shows', $_POST['interests'])){
      $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'Tv Shows')";
      $stmt = oci_parse($conn, $sql);
      $res = oci_execute($stmt);
  }
  if(in_array('Podcasts', $_POST['interests'])){
    $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'Podcasts')";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
  }
  if(in_array('Books', $_POST['interests'])){
  $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'Books')";
  $stmt = oci_parse($conn, $sql);
  $res = oci_execute($stmt);
  }
  if(in_array('Food', $_POST['interests'])){
    $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'Food')";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
}
if(in_array('Fashion', $_POST['interests'])){
  $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'Fashion')";
  $stmt = oci_parse($conn, $sql);
  $res = oci_execute($stmt);
}
if(in_array('Games', $_POST['interests'])){
  $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'Games')";
  $stmt = oci_parse($conn, $sql);
  $res = oci_execute($stmt);
}
   //$query = ("SELECT PROFILEID FROM PROFILES WHERE rownum = 1 ORDER BY PROFILEID DESC"); 
   //$s = oci_parse($conn, $query);
   //oci_execute($s);
   //$row = oci_fetch_array($s, OCI_NUM);
   //$UserID= $row[0];

   //$UserID = $UserID + 1; 
  
    $sql_test = "SELECT * FROM PROFILES where (username = '$username' or email='$email')";
      $stmt = oci_parse($conn, $sql_test);
      $res = oci_execute($stmt);
      if(($numrows= oci_num_fields($res)) > 0){ 
        $row = oci_fetch_row($res);
        if($username==$row["USERNAME"])
        { 
        header("Location:register.php?msgusername");
        }
        elseif($email==$row["EMAIL"]){ 
         header("Location:register.php?msgemail");
        }
    }

    else{ 
    $sql = "INSERT INTO PROFILES (fname, lname, email, username, pword, bio) VALUES ('$fname', '$lname', '$email', '$username', '$password', '$bio')";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
    if( !$res ){
        $error = oci_error($stmt);
        echo "An account with that username already exists!";
        //echo "Error: " . $error['message'] . "\n";
    }else{
      //  echo "OK\n";
      header("Location: index.php");
    }
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