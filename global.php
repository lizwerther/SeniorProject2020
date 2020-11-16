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
    
    $query = "SELECT * FROM Post WHERE postcategory = '".$cat."'";
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
  </head>  
  <body>
      
    <div class="bar">
      <div class="top-left">
          <a class="bar-item button" href="welcomepage.html"> 
            <b>LIST</b>ify
          </a>
      </div>
      <div class="top-right">
          <a class="bar-item button" href="global.php" >Global</a>
          <!-- <a href="following.html" class="bar-item button">Following</a> -->
          <a href="me.php" class="bar-item button">Me</a>
          <a href="index.php" class="bar-item button">Login</a>
          <a href="newpost.php" class="bar-item button">+</a>
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
                    <h2>$post[0]</h2>
                    <p>$post[1]</p>
                    <p>$post[2]</p>
                    <p>$post[3]</p>";
                    }
                    ?>            
                  </div>
    </body>
</html>