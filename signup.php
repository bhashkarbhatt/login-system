<?php 
 $showAlert = false;
 $showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'db.php';
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  
  //check whether username is already exists .....
  $existSql = "SELECT * FROM `users` WHERE username='$username'";
  $result = mysqli_query($conn, $existSql);
  $numExistsRows = mysqli_num_rows($result);
  if($numExistsRows > 0){
    $showError = "username already exists..";
  }
  else{
        if(($password == $cpassword)){
            $hash = password_hash("$password", PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
        $showAlert = true;
          }
        }      
        else{
              $showError = "Password do not match";
  
            }
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Signup</title>
</head>

<body>
    <?php
    
    require 'partial/nav.php';
    ?>
    <?php
    if($showAlert){
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>Your account is created now you can login
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($showError){
  echo '
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Error!</strong> '.$showError.'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
}
?>
    <div class="container">

        <h1 class="text-center">Signup to our Website...</h1>
        <form action="signup.php" method="post">
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" maxlength="11" class="form-control " id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" maxlength="30" class="form-control " id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control " id="cpassword" name="cpassword" placeholder="Confirm Password">
                <small id="emailHelp" class="form-text text-muted">Password should be same.</small>

            </div>
            <button type="submit" class="btn btn-primary" name="signup">SignUp</button>
        </form>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
