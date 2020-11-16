<?php
session_start();
$username = $_SESSION["USER"];
//echo $username; 

require "conn.php"; 
$conn = oci_connect('asheerin', 'sP01397995', 'csdb2.csc.Villanova.edu:1521/orcl.villanova.edu');
$query = "SELECT * FROM PROFILES WHERE username='$username'";
//echo $query;
$s = oci_parse($conn, $query);
oci_execute($s);
$resultarray = oci_fetch_row($s) or die("Unable to verify user because : " );

if(($row = oci_fetch_row($s)) != false)
{
 $rows[] = $row; 
}

$sql = "SELECT `name` FROM PROFILES WHERE username = '$username'";
$s = oci_parse($conn, $query);
oci_execute($s);
$resultarray = oci_fetch_row($s); 
$name = $resultarray[0];
$lname = $resultarray[1];

$sql2 = "SELECT `bio` FROM PROFILES WHERE username = '$username'";
$s2 = oci_parse($conn, $query);
oci_execute($s2);
$resultarray2 = oci_fetch_row($s2); 
$bio = $resultarray[5];

$sql4 = "SELECT interest FROM INTERESTS  WHERE username = '$username'";
$s4 = oci_parse($conn, $sql4);
oci_execute($s4);
$interestArray = Array(); 
while ($row = oci_fetch_assoc($s4)) {
   // echo $row["INTEREST"];
    array_push($interestArray, $row["INTEREST"]);
}

$postArray = Array();
$categories = Array();
$sql3 = "SELECT * FROM POST WHERE username = '$username' ORDER BY POSTID";
$s3 = oci_parse($conn, $sql3); 
oci_execute($s3);
while ($row = oci_fetch_assoc($s3)){ 
   $postArray[] = array($row["POSTTITLE"], $row["POSTCATEGORY"], $row["POSTRATING"], $row["POSTCONTENT"], $row["POSTID"]);
   array_push($categories, $row["POSTCATEGORY"]);
}
$categories = array_unique($categories);

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
      <div id = "block1">
                    <h2 class = "name"><?php echo $name, " "; echo $lname; ?></h2>
                    <p class="bio"><?php echo $bio; ?></p>
       </div>
       <div id = "block2">
                    <h2 class="category">Interests:</h2>
                    <!-- liz: can you change css of list to make 2 columns" -->
                    <?php foreach ($categories as $v) { 
                      //echo "<button type=\"button\"> $v </button>
                      echo "<ul title = \"$v\">";
                      foreach($postArray as $post) { 
                        if($post[1] == $v){ 
                          echo "<a href=\"#$post[4]\"> <li> $post[0] </li></a>";
                        }
                      }
                      echo "</ul>";
                    }

                    ?>
      </div>
                    <h2>Posts:</h2>
                    <div class= "Posts">
                    
                    <?php
                    foreach ($postArray as $post){ 
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