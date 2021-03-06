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

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type:"text/css" href="editprofile.css">
    <link rel="stylesheet" type:"text/css" href="navbar.css">
    <!-- <link href="css-me.css" rel="stylesheet">  -->
  </head>
  <body>
  <div class="bar">
      <div class="top-left">
          <a class="bar-item button" href="global.php">
          <img class="mb-4" src="./listify 1 white.png" alt="" width="100" height="35"> 
          </a>
      </div>
      <div class="top-right">
          <div class="dropdown">
              <a class ="dropbtn"> Profile
                <i class="fa fa-caret-down"></i>
</a>
              <div class="dropdown-content">
                <a href="me.php">Profile Page</a>
                <a href="newpost.php">New Post</a>
                <a href="editprofile.php">Edit Profile</a>
                <a href="index.php">Log Out</a>
              </div>
          </div>
          
      </div>
    </div>
  <div class="text-center">
    <form method="post" class="form-signin">

  <div class="main" >

  <h1 class="h3 mb-3 font-weight-normal">Edit Profile</h1>
  <div class="register">

  <label for="username_new" class="sr-only">Edit Username</label><br>
  <input type="EditUsername" class="form-control" placeholder="New Username" name="username_new"><br>
  <button type="submit" class="btn btn-lg btn-primary btn-block" name="EditUsername">Edit</button>

  <br>
  <label for="inputBio" class="sr-only">Edit Bio</label>
  <br><input type="EditBio" class="form-control" placeholder="New Bio" name= "bio_new" ><br>
  <button type="submit" class="btn btn-lg btn-primary btn-block" name="EditBio">Edit</button>

  </div>
  <!--<input name="interests" for ="inputInterests" > -->

  <p>Please select all of your new interests!</p>
    <div class="interests">
    Movies: <input type="checkbox" name="interests[]" value="movies"  /><br />
    TV Shows: <input type="checkbox" name="interests[]" value="tvshows"  /><br /> 
    Podcasts: <input type="checkbox" name="interests[]" value="podcasts"  /><br /> 
    Books: <input type="checkbox" name="interests[]" value="books"  /><br />
    Food: <input type="checkbox" name="interests[]" value="food"  /><br /> 
    Fashion: <input type="checkbox" name="interests[]" value="fashion"  /><br /> 
    Games: <input type="checkbox" name="interests[]" value="games"  /><br /> 
    </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block" name="EditInterests">Edit</button>
  <!--<p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p> -->
</div>
</form>
</div>
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
      $sql = "UPDATE INTERESTS SET USERNAME = '$username_new' WHERE USERNAME= '$username_old'";
      $stmt2 = oci_parse($conn, $sql);
      $res2 = oci_execute($stmt2);
      $sql = "UPDATE POST SET USERNAME = '$username_new' WHERE USERNAME= '$username_old'";
      $stmt2 = oci_parse($conn, $sql);
      $res2 = oci_execute($stmt2);
      
      session_destroy(); 
      header("Location:index.php?msgunchange");
  }
}

if(isset($_POST["EditBio"])){ 
    $bio_new = $_POST["bio_new"]; 
    $sql = "UPDATE PROFILES SET bio = '$bio_new' WHERE USERNAME= '$username_old'";
    $stmt2 = oci_parse($conn, $sql);
    $res2 = oci_execute($stmt2);
}
if(isset($_POST["EditInterests"])){ 
    $sql = "DELETE FROM INTERESTS WHERE USERNAME= '$username_old'";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);

    if(in_array('movies', $_POST['interests'])){
        $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username_old', 'movies')";
        $stmt = oci_parse($conn, $sql);
        $res = oci_execute($stmt);
    }
    if(in_array('tvshows', $_POST['interests'])){
      $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username_old', 'tvshows')";
      $stmt = oci_parse($conn, $sql);
      $res = oci_execute($stmt);
  }
    if(in_array('podcasts', $_POST['interests'])){
    $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username_old', 'podcasts')";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
  }
    if(in_array('books', $_POST['interests'])){
    $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username_old', 'books')";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
  }
    if(in_array('food', $_POST['interests'])){
    $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username_old', 'food')";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
}
    if(in_array('fashion', $_POST['interests'])){
    $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username_old', 'fashion')";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
}
    if(in_array('games', $_POST['interests'])){
    $sql = "INSERT INTO INTERESTS (username, interest) VALUES ('$username_old', 'games')";
    $stmt = oci_parse($conn, $sql);
    $res = oci_execute($stmt);
}

}



?>