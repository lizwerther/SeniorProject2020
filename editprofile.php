<?php
session_start();
$username_old = $_SESSION["USER"];
$conn = oci_connect('asheerin', 'sP01397995', 'csdb2.csc.Villanova.edu:1521/orcl.villanova.edu');
require "conn.php"; 
if(!$conn){ 
     echo "connection fail";
}
?>
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
    <img class="mb-4" src="./ListifyLogo.png" alt="" width="72" height="72">

  <div class="main" >

  <h1 class="h3 mb-3 font-weight-normal">Edit Profile</h1>
  <div class="register">

  <label for="username_new" class="sr-only">Edit Username</label><br>
  <input type="EditUsername" class="form-control" placeholder="New Username" name="username_new"><br>
  <button type="submit" class="btn btn-lg btn-primary btn-block" name="EditUsername">Edit</button>

  <br>
  <label for="inputBio" class="sr-only">Edit Bio</label>
  <br><input type="bio" class="form-control" placeholder="New Bio" name= "bio" ><br>
  <button type="submit" class="btn btn-lg btn-primary btn-block" name="EditBio">Edit</button>

  </div>
  <!--<input name="interests" for ="inputInterests" > -->

  <p>Please select all of your new interests!</p>
    <div class="interests">
    Movies: <input type="checkbox" name="interests[]" value="Movies"  /><br />
    TV Shows: <input type="checkbox" name="interests[]" value="Tv Shows"  /><br /> 
    Podcasts: <input type="checkbox" name="interests[]" value="Podcasts"  /><br /> 
    Books: <input type="checkbox" name="interests[]" value="Books"  /><br />
    Food: <input type="checkbox" name="interests[]" value="Food"  /><br /> 
    Fashion: <input type="checkbox" name="interests[]" value="Fashion"  /><br /> 
    Games: <input type="checkbox" name="interests[]" value="Games"  /><br /> 
    </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block" name="EditInterests">Edit</button>
  <!--<p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p> -->
</div>
</form>
</body>
</html>

<?php
$username_old = $_SESSION["USER"];
if(isset($_POST["EditUsername"])){ 
    $username_new = $_POST["username_new"]; 
    $sql_test = "SELECT * FROM PROFILES where (username = '$username_new')";
    $stmt = oci_parse($conn, $sql_test);
    $res = oci_execute($stmt);
    if((oci_num_rows($stmt)) > 0){ 
        $row = oci_fetch_row($stmt);
        if($username_new==$row["USERNAME"])
        { 
         header("Location:editprofile.php?msgusername");
        }
  }
  else{ 
      $sql = "UPDATE PROFILES SET USERNAME = '$username_new' WHERE USERNAME= '$username_old'";
      $stmt2 = oci_parse($conn, $sql);
      $res2 = oci_execute($stmt2);
  }
  session_destroy(); 
  header("Location:index.php?msgunchange");
}

// $bio = $_POST["bio"];
//    if(in_array('movies', $_POST['interests'])){
//         $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'movies')";
//         $stmt = oci_parse($conn, $sql);
//         $res = oci_execute($stmt);
//     }
//     if(in_array('tvshows', $_POST['interests'])){
//       $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'tvshows')";
//       $stmt = oci_parse($conn, $sql);
//       $res = oci_execute($stmt);
//   }
//   if(in_array('podcasts', $_POST['interests'])){
//     $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'podcasts')";
//     $stmt = oci_parse($conn, $sql);
//     $res = oci_execute($stmt);
//   }
//   if(in_array('books', $_POST['interests'])){
//   $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'books')";
//   $stmt = oci_parse($conn, $sql);
//   $res = oci_execute($stmt);
//   }
//   if(in_array('food', $_POST['interests'])){
//     $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'food')";
//     $stmt = oci_parse($conn, $sql);
//     $res = oci_execute($stmt);
// }
// if(in_array('fashion', $_POST['interests'])){
//   $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'fashion')";
//   $stmt = oci_parse($conn, $sql);
//   $res = oci_execute($stmt);
// }
// if(in_array('games', $_POST['interests'])){
//   $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username', 'games')";
//   $stmt = oci_parse($conn, $sql);
//   $res = oci_execute($stmt);
// }


?>