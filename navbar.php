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