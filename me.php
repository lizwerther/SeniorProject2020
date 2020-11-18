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
   $postArray[] = array($row["POSTTITLE"], $row["POSTCATEGORY"], $row["POSTRATING"], $row["POSTCONTENT"], $row["POSTID"], $row["USERNAME"]);
   array_push($categories, $row["POSTCATEGORY"]);
}
$categories = array_unique($categories);

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
                <a href="me.php">Profile Page</a>
                <a href="newpost.php">New Post</a>
                <a href="editprofile.php">Edit Profile</a>
                <a href="index.php">Log Out</a>
              </div>
          </div>
          <div class="top-right-right">
          <a class="signedin">Signed in: <?php echo "@", $username; ?></a>
        </div>
      </div>
    </div>
      <div id = "block1">
                    <h2 class = "name"><?php echo $name, " "; echo $lname; ?></h2>
                    <h3 class = "username"><?php echo "@", $username; ?></h3>
                    <p class="bio"><?php echo $bio; ?></p>
       </div>
       <div id = "block2">
                    <!--<h2 class="category">My Lists:</h2> -->
               
                    
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
                  <div id="Posts">
                    <h2>Posts:</h2>
                    <!-- <div class= "post"> -->
                    
                    <?php
                    foreach ($postArray as $post){ 
                     echo "<div class= \"postwrap\">
                     <div class= \"post\">
                    <p id=\"$post[4]\"> 
                    <div class=\"cat\">$post[1]</div>
                    <h2>$post[0]</h2>
                    <div class=\"un\">@$post[5]</div>
                    
                    <div class=\"rate\">$post[2]</div>
                    <div class=\"content\">$post[3]</div>
                    </div>
                    </div>";
                    }
                    ?>            
                  <!-- </div> -->
                  </div>
    </body>
</html>