<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
 if (!isset($_SESSION['userdata'])) {
 header("Location: login.php");
 }
if(!($_SESSION['userdata']['id_divisi'] == 2 && $_SESSION['userdata']['id_jabatan'] == 2 ) ){
    header("Location: index.php");
}
include "connection.php";
// $email = $query->table($ph)
?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#myTab li:eq(1) a").tab('show');
        $('table .tr-linkable').click(function() {
            window.location = $(this).attr('href');
            return false;
        });
    });
    </script>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style type="text/css">
    table th {
        text-align: center;
        vertical-align: middle;
    }

    table .tr-linkable {
        cursor: pointer;
    }

    a {
        color: white;
    }

    a :hover {
        color: white;
    }
    </style>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text-white">HR Dashboard</h1>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 text-left">
                
            <?php
        if($_SESSION['userdata']['id_divisi'] == 2 && $_SESSION['userdata']['id_jabatan'] == 2  ){
            echo '<a class=" btn btn-success" href="compose_form.php">Compose</a>';
        }
        ?>
            </div>
            <div class="col-md-12 text-right">
                <a class=" btn btn-dark" href='logout.php'>Keluar</a>
            </div>
        </div>
        <ul class="nav nav-tabs bg-dark" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#list_karyawan" role="tab" aria-controls="list_karyawan"
                    aria-selected="true">Daftar Karyawan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inbox-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all"
                    aria-selected="true">List Surat Peringatan</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="list_karyawan" role="tabpanel" aria-labelledby="list_karyawan-tab">
                <div class="row">
                    <div class="table-responsive col-md-12">

                        <table class="table table-bordered table-striped table-dark table-hover" >
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th>Tanggal Bergabung</th>
                                <th>Total SP</th>
                            </tr>
                            </thead>
                            <?php
                    $sql = $db->query("
                    SELECT *,
                    COUNT(ksm.id_ksm) AS `total_sp`
                    FROM karyawan `k`
                    natural join divisi
                    natural join jabatan
                    LEFT JOIN karyawan_surat_mapped `ksm` USING(id_karyawan)
                    GROUP BY k.id_karyawan
                    ");
                    foreach($sql as $row){

                    ?>
                            <tr>

                                <td><?php echo $row['full_name'];?></td>
                                <td><?php echo $row['nama_jabatan'];?></td>
                                <td><?php echo $row['nama_divisi'];?></td>
                                <td><?php echo date('l, d F Y ', strtotime($row['date_joined'])); ?></td>
                                <td><?php echo $row['total_sp'];?></td>
                            </tr>
                            <?php $no++; } ?>
                        </table>
                    </div>

                </div>

            </div>
            <div class="tab-pane fade show" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="row">
                    <div class="table-responsive col-md-12">

                        <table class="table table-bordered table-striped table-dark table-hover" >
                        <thead class="thead-light">
                             <tr>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th>tanggal terbit</th>
                            </tr>
                            </thead>
                            <?php
$sql = $db->query("select * 
from karyawan `k` 
natural join divisi `d`
natural join jabatan `j`
natural join surat_peringatan `sp` 
natural join karyawan_surat_mapped `ksm`
group by ksm.id_ksm

");
foreach($sql as $row){

?>
                            <tr class="tr-linkable" href='detail.php?id_ksm=<?php echo $row['id_ksm'];?>'>

                                <td><?php echo $row['full_name'];?></td>
                                <td><?php echo $row['nama_jabatan'];?></td>
                                <td><?php echo $row['nama_divisi'];?></td>
                                <td><?php echo date('l, d F Y ', strtotime($row['date'])); ?></td>
                            </tr>
                            <?php $no++; } ?>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </div>



</body>

</html>