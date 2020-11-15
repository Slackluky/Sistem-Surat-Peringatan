<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['username'])){
	include "connection.php";

	 $query =$db->query("SELECT * FROM karyawan WHERE
			 username='" .$_POST['username']."' AND password='" .$_POST['password']."'
			 ");

	$sql = $query->num_rows;
	if ($db->error=='') {
		if($sql>0){
			$userdata = $query->fetch_assoc();
			$_SESSION['userdata']=$userdata;
			if($userdata['id_divisi'] == 2 && $userdata['id_jabatan'] == 2  ){
				header("Location:hr_dashboard.php");
			}else{
				header("Location: index.php");
			}
			
		}else{
			$_SESSION['message']=['error'=>'Verifikasi gagal, cek username.'];
			 header("Location: login.php");
		}
	}else{
		$_SESSION['message']=['error'=>'Verifikasi gagal, silahkan coba lagi.'];
		header("Location: login.php");
	}
}else{
	header("Location: login.php");
}

?>

