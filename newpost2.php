<?php
session_start();  
$conn = oci_connect('asheerin', 'sP01397995', 'csdb2.csc.Villanova.edu:1521/orcl.villanova.edu');
require "conn.php"; 
if(!$conn){ 
   echo "connection fail";
}

?>
<html>
<head>
        <link rel="stylesheet" type:"text/css" href="navbar.css">
        <link rel="stylesheet" type:"text/css" href="css-me.css"> 
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
  <div id="blockpost">          
            <h3>Create a new post.</h3>
                <!-- <form method= "post"> -->
                  <!-- <label for="fname">Title</label> -->
                  Title<input type="title" id="title" name="title" placeholder="Post Title">
                  <label type = "category" for="category">Category</label>
                  <select name="category" id="category">
                    <option value="Movies">Movies</option>
                    <option value="TV Shows">Tv Shows</option>
                    <option value="Podcasts">Podcasts</option>
                    <option value="Food">Food</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Books">Books</option>
                    <option value="Games">games</option>
                  </select>
                  <!-- <input type="submit" id="category" name="category" placeholder="Category"> -->
                  <br>
                  <label type= "rating" for="type">Rating</label>
                  <select name="rating" id="rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  <!-- <input type="text" id="rating" name="type" placeholder="What would you rate this?"> -->
                  <br>
                  <label for="post">Post</label>
                  <input type="text" id="post" name="post" placeholder="Write your post here">
                   <!-- <textarea {
                      width: 100%;
                      height: 100px;
                      padding: 30px;
                      box-sizing: border-box;
                      border: 2px solid #ccc;
                      border-radius: 4px;
                      background-color: #f8f8f8;
                      font-size: 16px;
                      resize: none;
                   }></textarea> -->

                   <button type="submit" class="btn btn-lg btn-primary btn-block" name="submit">Post</button>
                </form>
              </div>
            </div>
        </a>
    </head>
    <body>

    </body>
</html>

<?php
if(isset($_POST["submit"])){ 
  $username = $_SESSION["USER"];
  $title = $_POST["title"];
  $title = str_replace("'", "''", $title);
  $category = $_POST["category"];
  $rating = $_POST["rating"];
  $post = $_POST["post"];
  $post = str_replace("'", "''", $post);


  $query = ("SELECT POSTID FROM POST ORDER BY POSTID DESC"); 
  $s = oci_parse($conn, $query);
  oci_execute($s);
  $row = oci_fetch_array($s, OCI_NUM);
  $PostID= $row[0];
  $PostID = $PostID + 1; 
 

  
  $sql = "INSERT INTO POST (username, POSTID, POSTTITLE, POSTCategory, POSTRating, PostContent) VALUES ('$username','$PostID', '$title', '$category', '$rating', '$post')"; 
  $stmt = oci_parse($conn, $sql);
  $res = oci_execute($stmt);
  if( !$res ){
      $error = oci_error($stmt);
      echo "Error: " . $error['message'] . "\n";
  }else{
  //echo "OK\n";
   // header("Location: newpost.php");
  }
}

?>
