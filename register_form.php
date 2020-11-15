<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userdata'])) {
	header("Location: index.php");
}
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Buat Akun</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<style>
.login-form {
    max-width: 768px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.3);
    padding: 30px;
    color: #f7f7f7;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
    max-width: 200px;
    margin: 0 auto;
}
.row{
   
    display: flex;
    align-items: center;
}

</style>
</head>
<body class="bg-dark">
<div class="container">
<div class="login-form">
    <form action="register.php" method="post" class="bg-dark" >
        <h2 class="text-center text-white">Register</h2>   
        <div class="row" >

        <div class="col-sm" >
        <div class="form-group">
            <label >username</label>
            <input type="text" class="form-control" placeholder="Username" name="username" required="required">
           
        </div>
        <div class="form-group">
            <label >full name</label>
            <input type="text" class="form-control" placeholder="full name" name="full_name" required="required">
           
        </div>
        

        
        <div class="form-group">
        <label for="exampleFormControlSelect1">divisi</label>
            <select name="divisi" class="form-control" id="exampleFormControlSelect1"> 
        <?php
        $sql = $db->query("select * from divisi");
        foreach($sql as $divisi){
        ?>
                
                       
            <option  value="<?php echo $divisi['id_divisi'] ?>"  required="required"><?php echo $divisi['nama_divisi']; ?></option>
            
                <?php } ?>

                </select>
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
        <label >jabatan</label>
            <select name="jabatan" class="form-control" > 
        <?php
        $sql = $db->query("select * from jabatan");
        foreach($sql as $jabatan){
        ?>             
            <option  value="<?php echo $jabatan['id_jabatan'] ?>"  required="required"><?php echo $jabatan['nama_jabatan']; ?></option>
            
                <?php } ?>

                </select>
            </div>

        <div class="form-group">
        <label >password</label>
            <input type="password" class="form-control" placeholder="Password" name="password" required="required">
        </div>
        <div class="form-group">
        <label >confirm password</label>
            <input type="password" class="form-control" placeholder="Confirm Password" name="password2" required="required">
        </div>
        </div>
        </div>
        <div class="form-group row mt-4">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <a type="button" class="btn btn-block btn-light" href="login.php">Login</a>
        </div>
        </div>      
        <?php
        	if (isset($_SESSION['message']['error'])) {
        		echo '<div class="text-danger text-center">'.$_SESSION['message']['error'].'</div>';
        		unset($_SESSION['message']['error']);
        	}
        ?>  
    </form>

</div>
</div>
</body>
</html>