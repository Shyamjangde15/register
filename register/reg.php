<html>
    <head>
        <meta charset="UTF-8">
                <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    </head>
    <body>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<header class="card-header">
    <a href="login.php" class="float-right btn btn-outline-primary mt-1">Log in</a>
    <h4 class="card-title mt-2">Sign up</h4>
</header>
<article class="card-body">
<form method="POST" enctype="multipart/form-data">
    <div class="form-row">
        <div class="col form-group">
            <label>First name </label>   
            <input type="text" class="form-control" name="fname" required>
        </div> <!-- form-group end.// -->
        <div class="col form-group">
            <label>Last name</label>
            <input type="text" class="form-control" name="lname">
        </div> <!-- form-group end.// -->
    </div> <!-- form-row end.// -->
    <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control" name="user" placeholder="Example@gmail.com" required>
        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div> <!-- form-group end.// -->
    <div class="form-group">
            <label class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gen" value="male">
          <span class="form-check-label"> Male </span>
        </label>
        <label class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gen" value="female">
          <span class="form-check-label"> Female</span>
        </label>
    </div> <!-- form-group end.// -->
    <div class="form-row">
        <div class="form-group col-md-6">
          <label>City</label>
          <input type="text" name="city" class="form-control" required>
        </div> <!-- form-group end.// -->
        <div class="form-group col-md-6">
            <label>Image</label>
            <input type="file" name="f1" class="form-control">
        </div>
    </div> <!-- form-row.// -->
    <div class="form-group">
        <label>Create password</label>
        <input class="form-control" type="password" name="pass" required>
    </div>
        <div class="form-group">
        <label>Conform password</label>
        <input class="form-control" type="password" name="cpass" required>
    </div> <!-- form-group end.// -->  
    <div class="form-group">
        <button type="submit" name="sub" class="btn btn-primary btn-block"> Register  </button>
    </div> <!-- form-group// -->      
    <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>                                          
</form>
</article> <!-- card-body end .// -->
<div class="border-top card-body text-center">Have an account? <a href="login.php">Log In</a></div>
</div> <!-- card.// -->
</div> <!-- col.//-->

</div> <!-- row.//-->


</div> 
    </body>
</html>
<?php
include 'connect.php';
if(isset($_POST['sub'])){
    $name=$_POST['fname'];
    $lname=$_POST['lname'];
    $user=$_POST['user'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $city=$_POST['city'];
    $gndr=$_POST['gen'];
    if($name == '' || $lname == '' || $user == '' || $pass== ''|| $cpass== '' || $gndr == ''){
     $error_message = "Please fill all fields.";
   }
    if($pass != $cpass){
     $error_message = "Confirm password not matching";
   }
   $s= "select * from reg where username='$user' and password= '$pass'";
   if (mysqli_num_rows($s) > 0) {
        $error_message = "Sorry... user already exist"; 
    }
    if($_FILES['f1']['name']){
    move_uploaded_file($_FILES['f1']['tmp_name'], "image/".$_FILES['f1']['name']);
    $img="image/".$_FILES['f1']['name'];
    }
    $i="insert into reg(name,lname,username,password,city,image,gender)value('$name','$lname','$user','$pass','$city','$img','$gndr')";
    mysqli_query($con, $i);
    header("location: home.php");
    $_SESSION['name']=$user;
}
?>