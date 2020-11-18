<?php
session_start();
$username = $_SESSION["USER"];
require "conn.php"; 
$conn = oci_connect('asheerin', 'sP01397995', 'csdb2.csc.Villanova.edu:1521/orcl.villanova.edu');

$sql4 = "SELECT interest FROM INTERESTS WHERE username = '$username'";
$s4 = oci_parse($conn, $sql4);
oci_execute($s4);
$interestArray = Array(); 
while ($row = oci_fetch_assoc($s4)) {
   // echo $row["INTEREST"];
    array_push($interestArray, $row["INTEREST"]);
}


$allposts = Array(); 
foreach($interestArray as $cat){ 
  echo $cat;
    $query = "SELECT * FROM Post WHERE postcategory = '$cat'";
    $s = oci_parse($conn, $query);
    oci_execute($s);
    while ($row = oci_fetch_assoc($s)){ 
        $allposts[] = array($row["USERNAME"], $row["POSTTITLE"], $row["POSTCATEGORY"], $row["POSTRATING"], $row["POSTCONTENT"], $row["POSTID"]);
     }
}



?>
<html>
    <head>
        <link rel="stylesheet" type:"text/css" href="css-me.css">
        <link rel="stylesheet" type:"text/css" href="navbar.css">
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
              <a href="me.php?username=<?php echo$username?>">Profile Page</a>
                <a href="newpost.php?username=<?php echo$username?>">New Post</a>
                <a href="editprofile.php?username=<?php echo$username?>">Edit Profile</a>
                <a href="index.php">Log Out</a>
                
              </div>
          </div>
          <div class="top-right-right">
          <a class="signedin">Signed in: <?php echo "@", $username; ?></a>
        </div>
      </div>
    </div>
       <div id = "block2">
                    <h2 class="category">Interests:</h2>
                    <?php foreach ($interestArray as $v) { 
                      //echo "<button type=\"button\"> $v </button>
                      echo "<ul title = \"$v\">";
                      foreach($allposts as $posts) { 
                        if($posts[2] == $v){ 
                          echo "<a href=\"#$posts[4]\"> <li> $posts[1] </li></a>";
                        }
                      }
                      echo "</ul>";
                    }

                    ?>
      </div>
                    <h2>Posts:</h2>
                    <div class= "Posts">
                    
                    <?php
                    foreach ($allposts as $post){ 
                     echo 
                    "<p id=\"$post[4]\">
                    <h2>$post[1]</h2>
                    <p>
                    by: $post[0]</p>
                    <p>$post[2]</p>
                    <p>$post[3]</p>";
                    }
                    ?>            
                  </div>
    </body>
</html>