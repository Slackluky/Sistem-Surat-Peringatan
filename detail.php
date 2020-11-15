<?php
if(!isset($_SESSION)){ 
   session_start(); 
}
 if (!isset($_SESSION['userdata'])) {
 	header("Location: login.php");
 }
 include "connection.php";
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
 </head>
 <body class="bg-dark">
 <?php

$sql = $db->query("
SELECT 
ksm.`id_ksm`,
ksm.`date`,
spt.`surat_peringatan_type_name`,
d.`nama_divisi`,
j.`nama_jabatan`,
k.`full_name`
FROM karyawan_surat_mapped `ksm`
NATURAL JOIN divisi `d`
NATURAL JOIN jabatan `j`
NATURAL JOIN karyawan `k`
NATURAL JOIN surat_peringatan_type `spt`
WHERE ksm.id_ksm ='".$_GET['id_ksm']."'
");
foreach($sql as $row){
$fullname = $row["full_name"];
$id_ksm = $row["id_ksm"];
$date = $row["date"];
$nama_jabatan = $row["nama_jabatan"];
$nama_divisi = $row["nama_divisi"];
$spt = $row["surat_peringatan_type_name"];
}
       ?>

 	<div class="container">
 		<div class="row">
 			<div class="col-md-12 text-center">
             <h2 >Surat Peringatan</h2>
             <h3>No : <?php echo $id_ksm;?></h3>
 			</div>
 		</div>
 		<br/>

                  <div class="card bg-dark spmail-card">
                           <div class="card-body">
                           <p>Kepada</p>
                           <p>Yth. <?php echo ucwords($fullname);?></p>
                           <p>Posisi : <?php echo ucwords($nama_jabatan);?></p>
                           <p>Divisi : <?php echo ucwords($nama_divisi);?></p>
                           <p class="text-right"><?php echo date('l, d F Y ', strtotime($date)); ?></p>
                           <p class="text-center"><b><?php echo $spt;?></b></p>
                           <p>Sehubungan dengan sikap kedisiplinan Saudara/Saudari sebagai karyawan yang memiliki kewajiban sepenuhnya untuk mematuhi dan melaksanakan peraturan serta disiplin dalam melaksanakan pekerjaan yang berlaku di kantor.
                               Maka, dengan ini Kami selaku pihak divisi                              
                               Sumber Daya Manusia atau SDM memberi peringatan Kepada <?php echo ucwords($fullname);?> selaku  <?php echo ucwords($nama_jabatan .' '. $nama_divisi);?> atas tindakan penyimpangan yang telah dilakukan sebagaimana mestinya seperti yang kami tuliskan sebagai berikut</p>
                           <p>Point-point Pelanggaran</p>
                           
                           <?php 
                        $sequel = $db->query("SELECT * FROM surat_peringatan `sp`
                        NATURAL JOIN sp_points `sps`
                        WHERE sp.id_ksm = '".$_GET['id_ksm']."'
                        GROUP BY sp.point_sp_id
                        ");
                        foreach($sequel as $key => $sprd){
                           $author = (int)$sprd["id_author"];
                           
                           ?>
                              <p>
                           <?php echo $key + 1,'. ', $sprd["point_sp_name"];?>
                           </p>
                           <?php }?>
                           <p>Demikian surat ini Kami sampaikan dan berlaku selama menjadi karyawan disini, kepada yang bersangkutan harap diperhatikan dan diperbaiki dengan segera</p>
                           <?php
                    $sql = $db->query("
                    SELECT *
                    FROM karyawan `k`
                    natural join divisi
                    natural join jabatan
                    where k.id_karyawan = ".$author."
                    ");
                    foreach($sql as $row){
                    ?>
                           <div class="text-left author">
                        <p>Mengetahui </p>
                        <p ><?php echo ucwords($row['nama_jabatan'] .' '. $row['nama_divisi']); ?><br/>
                        <?php echo ucwords($row['full_name']);?></p>
                        </div>
                            <?php } ?>
                        </div>
                     
                                   
</div>

         <div class="form-group row mt-4 spmail-button">
				<div class="col-md-12 text-center">
               <a href="index.php" class="btn btn-light">Back</a>
               <button onclick="window.print()" class="btn btn-primary">Print</button>
				</div>
				
			</div>
 	</div>	
 </body>
 </html>

