 <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  if (!isset($_SESSION['userdata'])) {
 	header("Location: login.php");

 }
 if($_SESSION['userdata']['id_divisi'] == 2 && $_SESSION['userdata']['id_jabatan'] == 2  ){
 include "connection.php";

$date = date('Y/m/d');
$id_karyawan = $_POST['id_karyawan'];
$body = $_POST['body'];
$sp_point = $_POST['sp_point'] ;
$maxid = $db ->query('select MAX(id_surat)+ 1 as maxid from surat_peringatan')->fetch_assoc();
$maxplus = $maxid['maxid'] + 1;

$ksp = $db ->query('SELECT id_karyawan,
DATE_ADD(`date`, INTERVAL 180 DAY) 
               AS  expiry_date
FROM karyawan_surat_mapped
HAVING id_karyawan = '.$id_karyawan.'
AND expiry_date > NOW()
')->num_rows;

$id_ksm = 'SP/' . $date .'/'. $id_karyawan .'/'. $maxplus;
$spid =$ksp + 1;


$exe = $db->query("
	INSERT INTO `karyawan_surat_mapped`(`id_ksm`, `id_karyawan`, `body`, `surat_peringatan_type_id`) 
   VALUES 
   (
    '".$id_ksm."',
   '".$id_karyawan."',
   '".$body."',
   '".$spid."' );
	");


foreach ($sp_point as  $row){
	$db->query("
	INSERT INTO `surat_peringatan`( `point_sp_id`,`id_ksm`, `id_author`) 
   VALUES 
   (
   '".$row."',
   '".$id_ksm."',
   '".$_SESSION['userdata']['id_karyawan']."' );
	");
}

//  try{
// 	$db -> autocommit(FALSE);
// 	$db->query("SELECT 
// 	@MessageID:= MAX(MessageID) +1
// 	FROM
// 	`users_messages_mapped`;");
// 	$db->query("
// 	SELECT 
//    @UserID:= UserID
//    FROM `users`
//    WHERE 
//    UserName = '".$_POST['username']."';
// 	");
// 	$db->query("
// 	INSERT INTO `messages`(`MessageID`, `Subject`, `Body`, `AuthorName`, `Date`) 
//    VALUES 
//    (@MessageID,
//    '".$_POST['subject']."',
//    '".$_POST['body']."',
//    '".$_SESSION["user"]."',
// 	CURRENT_TIMESTAMP);
// 	");
// 	$db->query("
// 	INSERT INTO `users_messages_mapped`(`MessageID`, `UserID`, `PlaceHolderID`, `IsRead`, `IsStarred`) 
//    VALUES 
//    (@MessageID,
//    @UserID,
//    1,
//    0,
//    0);
// 	");
// 	$db-> autocommit(TRUE);
// }
// catch (\Throwable $e) {
//     $db->rollback();
//     throw $e; 
// }

// if(mysqli_error($db)){
// 	echo "<script type='text/javascript'>
// 	alert('Error, You have not used our services before, so no details for you to visit and explore');
//  </script>";	
// }

// }

// else{
// 	echo "<script type='text/javascript'>
// 	alert('Error, Forbidden');
//  </script>";
header("Location: detail.php?id_ksm=$id_ksm");
}
 ?>