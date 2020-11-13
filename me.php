
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
    echo $row["INTEREST"];
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
        <link rel="stylesheet" type:"text/css" href="css.css">
        <div class="top">
            <div class="bar">
              <div class="top-left">
                <a href="example.html" class="bar-item button">
                <b>LIST</b>ify
                </a>
                </div>
                <div class="top-right">
                    <a href="global.html" class="bar-item button">Global</a>
                    <!-- <a href="following.html" class="bar-item button">Following</a> -->
                    <a href="me.html" class="bar-item button">Me</a>
                    <a href="sign-in.html" class="bar-item button">Login</a>
                    <a href="newpost.html" class="bar-item button">+</a>
                </div>
            </div>
          </div>
                <style>
                  input[type=text] {
                    width: 100%;
                    padding: 12px 20px;
                    margin: 8px 0;
                    box-sizing: border-box;
                    border: 3px solid #ccc;
                    -webkit-transition: 0.5s;
                    transition: 0.5s;
                    outline: none;
                    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
                  }
                  /* input[type=text]:focus {
                   border: 3px solid #555;
                  } */
                </style>
                  <div style = "padding-top: 200px;">
                    <p class = "name"><?php echo $name; ?></p>
                    <p class="bio"><?php echo $bio; ?></p>
                    <h2 class="category">Interests:</h2>
                   
                    <!-- liz: can you change css of list to make 2 columns" -->
                    <?php foreach ($categories as $v) { 
                      echo "<button type=\"button\"> $v </button>
                      <ul>";
                      foreach($postArray as $post) { 
                        if($post[1] == $v){ 
                          echo "<a href=\"#$post[4]\"> <li> $post[0] </li></a>";
                        }
                      }
                      echo "</ul>";
                    }

                    ?>
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
  
                <!--    <h2>Post Title</h2>
                    <p>Post content lalalalalalalal Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international pavilions, award-winning fireworks and seasonal special events. EMERYVILLE, Calif. — Huddled under blankets to brace against the cold, J.B. August and his buddies couldn’t help grinning as the doors of the boarded-up GameStop store finally opened. I’m just treating myself — it’s therapy,” said Mr. August, 35, before triumphantly carrying the device out of the store after 18 hours of waiting. “I never really have time to do anything for myself, so let me just go ahead and make an investment for myself and my peace of mind. The gaming craze on display in the Bay Area was echoed around the country this week as video gamers flocked to stores and crashed preorder websites in their rush to buy new video game consoles: Microsoft’s Xbox Series X and Sony’s PlayStation 5.";
                    </p>
                    <h2>Post Title</h2>
                    <p>Post content lalalalalalalal Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international pavilions, award-winning fireworks and seasonal special events. EMERYVILLE, Calif. — Huddled under blankets to brace against the cold, J.B. August and his buddies couldn’t help grinning as the doors of the boarded-up GameStop store finally opened. I’m just treating myself — it’s therapy,” said Mr. August, 35, before triumphantly carrying the device out of the store after 18 hours of waiting. “I never really have time to do anything for myself, so let me just go ahead and make an investment for myself and my peace of mind. The gaming craze on display in the Bay Area was echoed around the country this week as video gamers flocked to stores and crashed preorder websites in their rush to buy new video game consoles: Microsoft’s Xbox Series X and Sony’s PlayStation 5.";
                    </p>
                    <details>
                      <summary>First Post :P</summary>
                      <p>Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international pavilions, award-winning fireworks and seasonal special events.</p>
                    </details>
                    <h1>First Post :P</h1>
                    <p id="demo"></p>
                    <script>
                        document.getElementById("demo").innerHTML = "EMERYVILLE, Calif. — Huddled under blankets to brace against the cold, J.B. August and his buddies couldn’t help grinning as the doors of the boarded-up GameStop store finally opened. I’m just treating myself — it’s therapy,” said Mr. August, 35, before triumphantly carrying the device out of the store after 18 hours of waiting. “I never really have time to do anything for myself, so let me just go ahead and make an investment for myself and my peace of mind. The gaming craze on display in the Bay Area was echoed around the country this week as video gamers flocked to stores and crashed preorder websites in their rush to buy new video game consoles: Microsoft’s Xbox Series X and Sony’s PlayStation 5.";
                    </script> 
                    <h1>Second Post :{)</h1>
                    <p id="demo1"></p>
                    <script>
                        document.getElementById("demo1").innerHTML = "Hehe.#@$%&*^BJDSJHDdJKHF";
                    </script>   -->              
                  </div>
              </div>
            </div>
        </a>
    </head>
    <body>

    </body>
</html>