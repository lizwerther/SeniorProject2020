
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Log in to Listify</title>

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
      .body {
        height: 400px;
        background: linear-gradient(to bottom right, #4169E1 0%, #DA70D6 100%)
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    <link href="css.css" rel="stylesheet">
  </head>
  <body class="text-center">
      
<form action="login.php" method="post" class="form-signin">
  <img class="mb-4" src="./ListifyLogo.png" alt="" width="72" height="72">
  <br>
  <span style="color:red" > <?php
if(isset($_GET['msg']))
{
    $Message = "Your Password is incorrect. Try Again";
    print $Message;
}
if(isset($_GET['msg2']))
{
    $Message = "No account with that username. Try Again";
    print $Message;
}
?></span>
<div class="main">
  <h1 class="h3 mb-3 font-weight-normal">Sign in</h1>
  <label for="inputEmail" class="sr-only">Username</label><br>
  <input type="username" id="inputUsername" class="form-control" placeholder="Username" name="username" required>
  <br><label for="inputPassword" class="sr-only">Password</label>
  <br><input type="password" id="inputPassword" class="form-control" placeholder="Password" name ="password" prequired>
  <!-- <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div> -->
  <br><button class="btn btn-lg btn-primary btn-block" type="submit" name = "submit">Log in</button>
  <!--<p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p> -->
  <div class="links">
  <a href="register.php">Need an Account? Register Here</a>
  <!-- <br><a href="password_reset.php">Forgot your password? Reset it </a> -->
  </div>
</div>
</form>
</body>
</html>


