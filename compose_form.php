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
  include 'connection.php';
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 	<title>Buat SP</title>
	 <script src="js/jquery-3.5.1.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	 <script>
	 $(document).ready(function(){
		 $("#karyawaninput").keyup(function(){
			 var search = $(this).val();
			 if (search != ""){
				$.ajax({url: "get_data_karyawan.php",
				type: 'post',
				dataType: 'JSON',
				data: {search: search, type :1},
				 success: function(result){
					$("#dataList").empty();
				$.each(result, function(i, value){
					$("#dataList")
					.append("<li class='list-group-item' value1='"+value.id_karyawan+"' value2='"+value.nama_divisi+"' value3='"+value.nama_jabatan+"' value4='"+value.full_name+"'><i>result:</i><strong> "+value.full_name+"</strong></li>");
				});
				
				$('#dataList li').on('click', function() {
					$("#karyawaninput").val(this.getAttribute('value4'));
					$("#karyawan").val(this.getAttribute('value1'));
					$("#divisi").val(this.getAttribute('value2'));
					$("#jabatan").val(this.getAttribute('value3'));
					$("#dataList").empty();
});
				}});
			 } else{
				$("#dataList").empty();
			 }
		 });
		 ///////////////
		 var parental   		= $("#parent"); 
		 var trueparent   		= $("#trueParent"); 
				var selectW   		= $(".selectWrapper>select"); 
				var add_button      = $("#btnAdd"); 
				$('#remove_field').hide()
				$.ajax({url: "get_data_karyawan.php",
				type: 'post',
				dataType: 'JSON',
				data: {type :2},
				
				 success: function(points){
					 
			len = Object.keys(points).length;
				$.map(points, function(value, i){
				$(selectW).append("<option value="+value.point_sp_id+">"+value.point_sp_name+"</option>");
		
				})
				il = 1;
				$(add_button).click(function(e){ 
					if(il < len && il >= 1){
						console.log(points);
						$('#remove_field').show()
						$(parental).clone().appendTo($(trueparent));
					}
					il++;
					if(il == len){
						$(add_button).hide()
					}if(il == 1){
						$(add_button).show()
					}
				
				});
			}});

				$('#remove_field').click( function(e){ //user click on remove text
					il--;
					// $('#parent').remove();
					$(trueparent).children("div[id=parent]:last").remove();
					if(il == 1){
						$('#remove_field').hide();
					}if(il <= len){
						$(add_button).show()
					}
					
	})

				



});
	 </script>
	 <style>
			.centered-item{
	
	display: flex;
	align-items: center;
	}
	#btnAdd{
		height: calc(2.25rem + 2px);
	}
	#dataList{
		z-index: 5; 
		position : absolute;
		width: 69%;
	}
	#dataList :hover{
		cursor: pointer;
		background-color: #0a2a75;
		color: #fff;
		
	}
	 </style>
 </head>
 <body class="bg-dark" style="padding-top : 20px;">
 	<div class="container">
 		<div class="row">
 			<div class="col-md-12 text-center">
 				<h2 class="text-white">Buat Surat Peringatan</h2>
 			</div>
 		</div>
 		<br/>
 		<form action="compose.php" method="post">
		 <div class="form-group row">
				<label for="inputEmail3" class="col-sm-2  offset-sm-2 col-form-label text-white">Karyawan</label>
			    <div class="col-sm-6">
				  <input autocomplete="off" list="dataList" class="form-control" id="karyawaninput" placeholder="nama karyawan" required></input>
				  <input hidden id="karyawan"  name="id_karyawan" required></input>
				  <ul id="dataList" class="list-group"></ul>
				  
				</div>
			</div>
			<div class="form-group row">
			<div class="offset-sm-4"></div>
				<div class="col-sm-3">
				<input id="divisi" class="form-control" placeholder="divisi" disabled></input>
				</div>
				 
			</div>

			<div class="form-group row">
			<div class="offset-sm-4"></div>
				<div class="col-sm-3">
				  <input id="jabatan" class="form-control" placeholder="jabatan" disabled></input>
				 </div>
				 
			</div>

			<div class="form-group card bg-dark row border-0" >
			<div id="trueParent">
			<label for="inputEmail3" class="col-sm-2  offset-sm-2 col-form-label text-white">Pelanggaran</label>
				<div id="parent" class="col-sm-6 centered-item offset-sm-4" style="margin-bottom: 20px;">
			    <div  class="selectWrapper">
				<select name="sp_point[]" class="form-control align-middle selectorClass0" id="pointsField">
				</select>
				 </div>
			</div>
			</div>
			<div class="col-sm-6 offset-sm-4 mt-3">
			<button type="button" class="btn btn-danger float left" href="#" id="remove_field">Remove</button>
			<button type="button" id="btnAdd" class="btn btn-success float-right">Add</button>
			</div>
			<!-- <label for="inputEmail3" class="col-sm-2  offset-sm-2 col-form-label text-white">Custom</label>
			<div class="offset-sm-4"></div>
				<div class="col-sm-3">
				  <input id="jabatan" class="form-control" placeholder="jabatan" disabled></input>
				 </div> -->
			</div>
			
			
			<div class="form-group row">
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Send</button>
					<a href="index.php" class="btn btn-light">Cancel</a>
				</div>
				
			</div>
		</form>
 	</div>	
 </body>
 </html>

