
<?php
session_start();

//echo $_SESSION["USER"];
$email = $_SESSION["USER"];

require "conn.php"; 
$conn = oci_connect('asheerin', 'sP01397995', 'csdb2.csc.Villanova.edu:1521/orcl.villanova.edu');
$query = "SELECT * FROM PROFILES WHERE email='$email'";
//echo $query;
$s = oci_parse($conn, $query);
oci_execute($s);
$resultarray = oci_fetch_row($s) or die("Unable to verify user because : " );


if(($row = oci_fetch_row($s)) != false)
//echo mysql_result($result,0);  // for correct login response
{
 $rows[] = $row; 
 }
 // close the database connection

// echo the application data in json format
//echo json_encode($rows);
//$print = $rows[0]; 
//echo $print;

$sql = "SELECT `name` FROM PROFILES WHERE email = '$email'";
$s = oci_parse($conn, $query);
oci_execute($s);
$resultarray = oci_fetch_row($s); 
$name = $resultarray[1];

$sql2 = "SELECT `bio` FROM PROFILES WHERE email = '$email'";
$s2 = oci_parse($conn, $query);
oci_execute($s2);
$resultarray2 = oci_fetch_row($s2); 
$bio = $resultarray[7];


//$result = mysqli_query($conn,$sql);
//$resultarr = mysqli_fetch_assoc($result);
//$name = $resultarr["name"];
//echo $name;


?>
<html>
    <head>
        <link rel="stylesheet" type:"text/css" href="css.css">
        
    </head>
    <body>
        <div class="top">
            <div class="bar">
                <div class="top-left">
                <a href="example.html" class="bar-item button">
                <b>LIST</b>ify
                </a>
                </div>
            <!-- add css-->
                <div class="top-right">
                    <a href="global.html" class="bar-item button">Global</a>
                    <a href="following.html" class="bar-item button">Following</a>
                    <a href="me.html" class="bar-item button">Me</a>
                    <a href="sign-in.html" class="bar-item button">Login</a>
                </div>
            </div>

        </div>
        <div class="header">
            <div class="name">
                <a><?php echo $name; ?> </a>
            </div>
            <div class="bio">
                <ul><b>ABOUT ME</b>
                    <li><?php echo $bio; ?></li>
                </ul>
            </div>
        </div>
        
   <!--     <div class="sections">
                <div class="category">
                    <div class="section1">
                        <ul><b>Books</b>
                        <li>The Things We Cannot Say</li>
                        <li>Verity</li>
                        <li>I Owe You One</li>
                        <li>Fool Me Once</li>
                        <li>Summer Sisters</li>
                    </ul></div>
                
                    <div class="section2">
                        <ul><b>Movies</b>
                        <li>Step Brother</li>
                        <li>My Sister's Keeper</li>
                        <li>Remember Me</li>
                        <li>The Longest Ride</li>
                        <li>Cheaper by the Dozen</li>
                        </ul>
                    </div>

                    <div class="section3">
                        <ul><b>TV Shows</b>
                        <li>Friends</li>
                        <li>The Office</li>
                        <li>One Tree Hill</li>
                        <li>Parks & Rec</li>
                        <li>Indian Match Maker</li>
                    </ul>
                    </div>

            </div>
        </div>
-->

    <!-- <div class="section 1">
        <div class="row">
        <div class="column">
      <h3>Books</h3>
      <p>Little Fires Everywhere</p>
    </div>
    <div class="column">
      <h3>Podcasts</h3>
      <p>How I Built This</p>
    </div>
    <div class="column">
      <h3>TV Shows</h3>
      <p>All American</p>
    </div>
  </div> -->
</body>
</html>
