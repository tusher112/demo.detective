<?php
if(isset($_POST['submit'])){
  if($_POST['name']== "" ){
    $error_msg['name'] = "name is required";
  }

  $name=$_POST['name'];
  if(!preg_match("/^[a-zA-Z -]*$/",$name)) {
    $error_msg['name']=" Only Letters allows";
  }

  
  $email= $_POST['email'];
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error_msg['email']= "Invalid Email";
    if($_POST['email']== "" ){
      $error_msg['email'] = "Email is required";
    }
  }

  $psw=$_POST['psw'];
  $psw_repeat=$_POST['psw-repeat'];
  if(empty($psw)){
    $error_msg['psw']= "Password is required";
  }
  if(empty($psw_repeat)){
    $error_msg['psw-repeat']= "Confirm Password is required";
  }
  

  else if($psw!=$psw_repeat){
    $error_msg['psw-repeat'] = "Confirm password not matched";
  }
 

  if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $psw)) {
    $error_msg['psw'] = "Password should contains at least eight characters, including at least one number and includes both lower and uppercase letters and special characters.";
  }

  // $error_msg='';
  if(!$error_msg){
    $db = new mysqli("localhost", "root", "", "validation");

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST ['psw'];

    $query = "INSERT INTO information (name, email, password) VALUES('$name', '$email', md5('.$password.'))";
    $run = mysqli_query($db, $query);
    
    if($run){
        echo "Registration Successfull";
    }

    else{
        echo "error".mysql_error($db);
    }
}


  }
  else{
    $fail="Please fil up all required fields*";
  }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>How To create Sign Up and Registration Form HTML Using Bootstrap 4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style>
.error{
  color:red;
  
}

.error::before{
  content: "* "
}

  </style>
</head>
<body>
  <div class="container">   
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <!-- Sign Up form -->
        <form action="reg.php" method="post" enctype="multipart/form-data" class="Signup">
          <h3>Sign Up Now!!!</h3>
          <div class="form-group">
              <label for="name">Full Name</label>
            <input type="text" class="form-control" placeholder="Full Name" name="name" autocomplete="off" >
              <?php
                if(isset($error_msg['name'])){
                  echo "<div class='error'>" .$error_msg['name']. "</div>";
                }
              ?>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
            <input type="text" class="form-control" placeholder="Enter Email" name="email" >

            <?php
                if(isset($error_msg['email'])){
                  echo "<div class='error'>" .$error_msg['email']. "</div>";
                }
              ?>

          </div>      
          <div class="form-group">
              <label for="psw">Password</label>
            <input type="password" class="form-control" placeholder="Enter Password" name="psw" > 

            <?php
                if(isset($error_msg['psw'])){
                  echo "<div class='error'>" .$error_msg['psw']. "</div>";
                }
                // if(isset($error_msg['psw3'])){
                //   echo "<div class='error'>" .$error_msg['psw3']. "</div>";
                // }
              ?>

          </div>   
          <div class="form-group">
            <label for="psw-repeat">Repeat Password</label>
            <input type="password" class="form-control" placeholder="Repeat Password" name="psw-repeat" >
                
            <?php
                if(isset($error_msg['psw-repeat'])){
                  echo "<div class='error'>" .$error_msg['psw-repeat']. "</div>";
                }
              ?>
          
          </div>
          <div class="form-group">
            <label>Profile Photo</label>
            <input type="file" id="Profile-pic" name="channel-img" class="form-control">
            <label for="Profile-pic" class="choose-icon"><i class="fa fa-camera" aria-hidden="true"></i></label>
          </div>
          <div class="form-group">
            <label class="term-policy"><input type="checkbox"> By creating an account you agree to our <a href="#">Terms & Privacy</a>.</label>
          </div>
          <button  type="submit"  class="btn btn-success" name="submit">Signup</button>
          <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
          <hr>
          <div class="form-group">
            <p class="not-yet">Already have an account? <a href="login.html">Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>