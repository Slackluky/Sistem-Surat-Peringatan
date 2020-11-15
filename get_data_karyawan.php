<?php
include "connection.php";

$type = 0;
if(isset($_POST['type'])){
    $type = $_POST['type'];
}

if ($type == 1){
    $searchText = mysqli_real_escape_string($db,$_POST['search']);
    $sql =  $db->query("select full_name,
      id_karyawan,
      nama_divisi,
      nama_jabatan
      from karyawan
      natural join divisi
      natural join jabatan
        where full_name like '%".$searchText."%';
        ");
    foreach ($sql as $list ){
       $arr[]= $list;
    };
    $karyawan = (object)$arr;
    echo json_encode($karyawan);
}

if ($type == 2){
    $sql =  $db->query("select * from sp_points");
    foreach ($sql as $list ){
       $arr[]= $list;
    };
    echo json_encode($arr);
}

?>