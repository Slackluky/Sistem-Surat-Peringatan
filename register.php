<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userdata'])) {
	header("Location: index.php");
};
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])) {
	if ($_POST['password']!=$_POST['password2']) {
		$_SESSION['message']['error']='Password tidak sama';
		include_once('register_form.php');
	}else{
		include ('connection.php');

		$usernamecheck = $db->query("select * 
		from karyawan
		where username = '".$_POST['username']."'
		")->num_rows;
		if($usernamecheck == 0){
			$query =$db->query("INSERT INTO karyawan SET
			 username='" .$_POST['username']. "',
			 password='" .$_POST['password']."',
			 full_name='" .$_POST['full_name']. "',
			 id_jabatan='" .$_POST['jabatan']. "',
			 id_divisi='" .$_POST['divisi']. "'
			 ");
			 	if($query){
					$_SESSION['message']=['success'=>'Akun sudah dibuat'];
					header("Location:login.php");
				}else{
				   $_SESSION['message']=['error'=> $db->error];
				   header("Location: register_form.php");
				}
		}else{
			$_SESSION['message']=['error'=> 'username sudah terpakai'];
			header("Location: register_form.php");
		}
		 	

	 }
	

}else{
	header("Location: register_form.php");
}


?>