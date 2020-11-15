<?php
use helper\quero\quero;
if(!isset($_SESSION)){ 
  session_start(); 
}
 if (!isset($_SESSION['userdata'])) {
 header("Location: login.php");
 }
 if(($_SESSION['userdata']['id_divisi'] == 2 && $_SESSION['userdata']['id_jabatan'] == 2 ) ){
    header("Location: hr_dashboard.php");
}
include "connection.php";
include ("helper/quero.php");
$quero = new quero($db);
// $email = $query->table($ph)
?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
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

            <?php
                $sql =$db->query("SELECT nama_divisi from divisi
                where id_divisi = ".$_SESSION['userdata']['id_divisi']."
                ")->fetch_assoc();
                echo '<h1 class="text-white">'.$sql['nama_divisi'].' Dashboard</h1>'
                ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-12 text-right">
                <a class=" btn btn-dark" href='logout.php'>Keluar</a>
            </div>
        </div>
        <ul class="nav nav-tabs bg-dark" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#list_karyawam" role="tab" aria-controls="list_karyawan"
                    aria-selected="true">Daftar Karyawan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inbox-tab" data-toggle="tab" href="#unread" role="tab" aria-controls="unread"
                    aria-selected="true">Unread</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inbox-tab" data-toggle="tab" href="#inbox" role="tab" aria-controls="inbox"
                    aria-selected="true">Inbox</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="spam-tab" data-toggle="tab" href="#spam" role="tab" aria-controls="spam"
                    aria-selected="true">spam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="trash-tab" data-toggle="tab" href="#trash" role="tab" aria-controls="trash"
                    aria-selected="false">trash</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="sent-tab" data-toggle="tab" href="#sent" role="tab" aria-controls="sent"
                    aria-selected="false">Sent</a>
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
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
$sql = $db->query("select * from messages  natural join users_messages_mapped natural join messageplaceholders
where UserID ='".$_SESSION['UserID']."'
order by date desc");
while($row=$sql->fetch_assoc()){

?>
                            <tr class="tr-linkable" href='detail.php?MessageID=<?php echo $row['MessageID'];?>'>

                                <td><?php echo $row['AuthorName'];?></td>
                                <td><?php echo $row['Subject'];?></td>
                                <td><?php echo $row['Body'];?></td>
                                <td><?php echo $row['Date'];?></td>
                                <td>
                                <?php
                                if ($row['IsStarred']==1){
                                    echo "<img src='icons/star-fill.svg' alt='starred' width='16' height='16' ></img>";
                                }
                                else echo "<img src='icons/star.svg' alt='starred' width='16' height='16' style='color: yellow;' ></img>";
                                ?>
                            </td>
                                <!-- <td class="text-center">
 				<a class="btn btn-primary" href='pinjam_form.php?id=<?php echo $row['id'];?>'>Edit</a>
 				<a  class="btn btn-danger"  href='pinjam_hapus.php?id=<?php echo $row['id'];?>'>Hapus</a>
 			</td> -->
                            </tr>
                            <?php $no++; } ?>
                        </table>
                    </div>

                </div>

            </div>
            <div class="tab-pane fade show" id="unread" role="tabpanel" aria-labelledby="unread-tab">
                <div class="row">
                    <div class="table-responsive col-md-12">

                        <table class="table table-bordered table-striped table-dark table-hover" >
                        <thead class="thead-light">
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Body</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <?php
$sql = $db->query("select * from messages natural join users_messages_mapped
where UserID ='".$_SESSION['UserID']."' AND IsRead = 0
order by date desc");
while($row=$sql->fetch_assoc()){

?>
                            <tr class="tr-linkable" href='detail.php?MessageID=<?php echo $row['MessageID'];?>'>

                                <td><?php echo $row['AuthorName'];?></td>
                                <td><?php echo $row['Subject'];?></td>
                                <td><?php echo $row['Body'];?></td>
                                <td><?php echo $row['Date'];?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>

                </div>

            </div>
            <div class="tab-pane fade" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">
                <div class="row">
                    <div class="table-responsive col-md-12">

                        <table class="table table-bordered table-striped table-dark table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Body</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                            <?php
    foreach($quero->table(3, $_SESSION["UserID"]) as $row) {
?>
                            <tr class="tr-linkable" href='detail.php?MessageID=<?php echo $row['MessageID'];?>'>
                                    <td><?php echo $row['AuthorName'];?></td>
                                    <td><?php echo $row['Subject'];?></td>
                                    <td><?php echo $row['Body'];?></td>
                                    <td><?php echo $row['Date'];?></td>
                                   
                                  </tr>
                            <?php  } ?>
                        </table>
                    </div>

                </div>

            </div>
            <div class="tab-pane fade" id="spam" role="tabpanel" aria-labelledby="spam-tab" style="color: white;">
                <div class="row">
                    <div class="table-responsive col-md-12">

                        <table class="table table-bordered table-striped table-dark table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Body</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                            <?php
foreach($quero->table(3, $_SESSION["UserID"]) as $row) {
?>
                            <tr class="tr-linkable"  href='detail.php?MessageID=<?php echo intval($row['MessageID']);?>'>
                                    <td><?php echo $row['AuthorName'];?></td>
                                    <td><?php echo $row['Subject'];?></td>
                                    <td><?php echo $row['Body'];?></td>
                                    <td><?php echo $row['Date'];?></td>
                              
                            </tr>
                            <?php } ?>
                        </table>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab" style="color: white;">
                <div class="row">
                    <div class="table-responsive col-md-12">

                        <table class="table table-bordered table-striped table-dark table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Body</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                            <?php

    foreach($quero->table(2, $_SESSION["UserID"]) as $row) {
?>
                             <tr class="tr-linkable" href='detail.php?MessageID=<?php echo $row['MessageID'];?>'>
                                 
                                     <td><?php echo $row['AuthorName'];?></td>
                                     <td><?php echo $row['Subject'];?></td>
                                     <td><?php echo $row['Body'];?></td>
                                     <td><?php echo $row['Date'];?></td>
                                
                             </tr>
<?php }
                         ?>
                        </table>
                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab" style="color: white;">
                <div class="row">
                    <div class="table-responsive col-md-12">

                        <table class="table table-bordered table-striped table-dark table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>To:</th>
                                <th>Subject</th>
                                <th>Body</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                            <?php
$sql = $db->query("select * from messages natural join users_messages_mapped natural join users
where AuthorName ='".$_SESSION['user']."'
order by date desc");
foreach($sql as $row){
?>
                            <tr class="tr-linkable" href='detail.php?MessageID=<?php echo $row['MessageID'];?>'>
                               
                                    <td><?php echo $row['UserName'];?></td>
                                    <td><?php echo $row['Subject'];?></td>
                                    <td><?php echo $row['Body'];?></td>
                                    <td><?php echo $row['Date'];?></td>
                       
                            </tr>
                            <?php } ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>



</body>

</html>