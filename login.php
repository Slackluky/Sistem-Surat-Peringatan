<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userdata'])) {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Email App Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<style>
.login-form {
    max-width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.btn {        
    font-weight: bold;
}
</style>
</head>
<body class="bg-dark">
<div class="login-form">
    <form action="verify.php" method="post" class="bg-dark">
        <h2 class="text-center text-white">Login</h2> 
     
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required="required">
        </div>
        <div class="form-group row text-center" >
            <div class=" col-md-12 ">
            <button type="submit" class="btn btn-primary">Sign In</button>
            
            </div>
            <div class=" col-md-12 mt-3 ">
            <a class="btn btn-light" href="register_form.php">Register</a>
            </div>
            
           
        </div>
    </form>
    <?php
        if (isset($_SESSION['message']['success'])) {
               echo '<div class="text-center text-success">'.$_SESSION['message']['success'].'</div>';
               unset($_SESSION['message']['success']);
        }
         if (isset($_SESSION['message']['error'])) {
               echo '<div class="text-center text-danger">'.$_SESSION['message']['error'].'</div>';
               unset($_SESSION['message']['error']);
        }
        ?> 
</div>
</body>
</html>