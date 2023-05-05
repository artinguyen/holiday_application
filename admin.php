<?php 
$auth = false;
if( isset($_GET['user']) && isset($_GET['pass']) ) {
  	if($_GET['user'] == 'admin' && $_GET['pass'] == 'vlDQNrLVOz') {
  		$auth = true;  
 	} else {
		header('HTTP/1.0 403 Forbidden');
		echo 'You are forbidden!';
		exit();
	}
} else {
	header('HTTP/1.0 403 Forbidden');
	echo 'You are forbidden!';
	exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>[Web] Off-WFH-Late</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="favicon.png">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<style>
	.tableContainer {
		max-height: 450px;
		overflow-y: auto;
	}
	.table {
		position: sticky;
		top: 0;
		width: 100%;
	}
	.table th {
		background: #efe0d1;
		position: sticky;
		top: -1px;
		border-top: 1px solid black;
	}
	.container {
		width: auto;
		border-radius: 3px;
		margin-top: 20px;
	}
	label {
		color: black;
	}
	input, select {
		width: auto;
		display: inline;
		border-bottom: 1px solid black;
	}
	#type{
		padding: 5px;
		width: 100px;
	}
	h1{
			text-align: center;
		background: grey;
		padding: 20px;
		}
	.main{
		padding:0;
	}
	.container{
		border: 1px solid #cdcdcd;
	}
	#list_view{
		width: auto;
		background: #4966b1;
		color: #fff;
		line-height: 4;
		font-size: 15px;
		border: none;
		border-radius: 5px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-o-border-radius: 5px;
		-ms-border-radius: 5px;
		cursor: pointer;
		box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
		-moz-box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
		-webkit-box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
		-o-box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
		-ms-box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
		text-decoration: none;
		margin-bottom:20px;
		padding: 16px 17px;
	}
	@media (max-width: 576px) {
		input{
		width: 100%;
		}
		th{
		text-align: center;
		vertical-align: middle !important;
		}
	}

	@media (max-width: 768px) {
		input{
		width: 100%;
		}
		th{
		text-align: center;
		vertical-align: middle !important;
		}
	}
	#name{
		border: 1px solid black;
		padding: 3px;
		border-radius: 3px;
	}
	input[type='file'] { font-size: 0; }
	::file-selector-button { font-size: initial; }

	.upload input{
		border: 0;
		/* border: initial; */
		margin-bottom: 0;
	}
	.summary{
		margin-top: 30px;
		color: #000;
		margin-bottom: 30px;
	}
	.summary td{
		border: 1px solid black;
		padding: 5px;
	}
	.download_csv{
		margin-top: 30px;
		float: right;
	}
	#list-table td p{
		margin-bottom: 2px;
		height: 38px;
		line-height: 38px;
	}
	.upload {
		height: 41px;
		margin-top: -1px;
	}
	.ui-datepicker-calendar {
    	display: none;
	}
	</style>
</head>
<body>
<h1 style="text-align:center">OFF - WFH - LATE</h1>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
		<h2>Danh sách thành viên</h2>
		<div class="form-group">
			<div class="alert alert-danger" style="display:none"></div>
			<div class="alert alert-success" style="display:none"></div>
			<label for="date">Tháng:</label>
			<input id="date" type="text">
			<!-- <label for="date">Đến ngày:</label>
			<input id="date_to" type="text"> -->
			<div class="form-submit">
				<label for="filter">Hiển thị theo team:</label>
				<input id="filter" type="radio" name="filter" value="BE">
				<label for="filter">Backend</label>
				<input id="filter" type="radio" name="filter" value="FE">
				<label for="filter">Frontend</label>
				<input id="filter" type="radio" name="filter" value="">
				<label for="filter">All</label>      
			</div>
		</div>
			<div class="tableContainer">
				<table class="table table-striped" id="list-table">
					<thead>
					<tr>
						<th>STT</th>
						<th>Họ và tên</th>
						<th>Team</th>
						<th>Ngày</th>
						<th>Lý do</th>
						<th>Phạt</th>
						<th>Evidence</th>
					</tr>
					<tbody></tbody>
				</table>
      		</div>
    	</div>
  	</div>

	<div class="row">
	<div class="col-lg-6">
		<table class="summary">
			<tr>
			<td><b>Tổng số phạt</b></td><td><span class="total_user">0</span></td>
			</tr>
			<tr>
			<td><b>Tổng số evidence</b></td><td><span class="total_evidence">0</span></td>
			</tr>
		</table>
	</div>
	<div class="col-lg-6">
		<a href="#" class="btn btn-info download_csv">Tải file thống kê theo tháng</a>
	</div>
	</div>
</div>
<script>
$(document).ready(function(){
	
	$( "#date" ).datepicker({ defaultDate: new Date(), 
		changeMonth: true,
        changeYear: true,
        dateFormat: 'mm/yy',
		onClose: function() {
        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
		init(getDate());
     }
	}).on("change", function() {
		// Clear radio button
		$('input[type=radio]').prop('checked', false);
		$.ajax({
		type: "GET",
		url: 'admin/members_list.php?date='+getDate(),
		data: {},
		dataType  : 'json',
		success   : function(response) {
			if (response) {
				var text = '';
				var list = response.data;
				$.each(list, function(key, val) {
					let reason = '';
					if(typeof val.reason !== "undefined") {
						reason = val.reason;
					}
					text += '<tr data-id="'+ val.id +'"><td>'+ (key+1) +'</td><td>' + val.text + '</td><td>'+ val.team + '</td><td>' + reason + '</td><td>';
					if(typeof val.content !== 'undefined' && val.content == 'true') {
						text += 'Đã phạt';
					} else {
						text += '<button id="update_content" data-id="'+ val.id +'" type="button" class="btn btn-warning">Phạt</button>';
					}
						text += '</td><td>';
					if(typeof val.evidence !== 'undefined' && val.evidence != '') {
						text += '<a href="uploads/'+ val.evidence +'" target="_blank" class="btn btn-info">Evidence</a>';
					} else {
						text += '<form class="upload"><input type="file" title="" name="evidence" accept="image/png, image/gif, image/jpeg"/><input type="submit" value="Upload" class="btn btn-primary"></form>';
					}
					text += '</td></tr>';
				})
				if(text == '') {
					text += '<tr><td colspan="5" style="text-align:center">Không có dữ liệu</td></tr>';
				}
				// Summary
				$(".total_user").text(response.summary.total_user);
				$(".total_evidence").text(response.summary.total_evidence);
				$('#list-table tbody tr').remove();
				$('#list-table tbody').append(text);
			} 
      	} // ./ Success
    }); // ./ Ajax
  	}).datepicker("setDate", new Date());// ./ Change date event
		
	$('body').on('click', '#update_content', function(){
		let id = $(this).attr('data-id');
		let date = $(this).attr('data-date');
		let self = this;
		$.ajax({
			type: "POST",
			url: 'admin/update_content.php',
			data: {id, date},
			dataType  : 'json',
			success   : function(response) {
				if(response.success) {
					$('.alert-success').text(response.success).show();
					$(self).closest('p').text('Đã phạt');
				} else {
					$('.alert-danger').text(response.error).show();
				}
				setTimeout(function () {
				$('.alert').hide();
				}, 2000);
				// Load again page
				init(getDate());
			}
		});
		return false;
	})

	$('input[type=radio][name=filter]').change(function() {
		filter(this.value);
	});

   // Init
   init('');

   // Download csv
   $('.download_csv').click(function(){
		let date = $('#date').val();
		let registerdDate1 = (date.split("/"));
		let date1 = registerdDate1[2]+'-'+registerdDate1[1]+'-'+registerdDate1[0];
		window.location.href = 'admin/download_csv.php?date='+date1;
   })
}) // ./ Document

function filter(name) {
	var input, filter, table, tr, td, i, txtValue;
	filter = name.toUpperCase();
	table = document.getElementById("list-table");
	tr = table.getElementsByTagName("tr");
	// Loop through all table rows, and hide those who don't match the search query
	for (i = 0; i < tr.length; i++) {
		if(name == 'BE' || name == 'FE') {
		td = tr[i].getElementsByTagName("td")[2];
		} else {
		td = tr[i].getElementsByTagName("td")[0];
		}
		if (td) {
		txtValue = td.textContent || td.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			tr[i].style.display = "";
		} else {
			tr[i].style.display = "none";
		}
		}
	}
	$(".no-data").remove();
	if($('#list-table tbody tr:visible').length == 0) {
		$('#list-table tbody').append('<tr class="no-data"><td colspan="4" style="text-align:center; background-color: rgba(0,0,0,.05);">Không có dữ liệu</td></tr>');
	}
}

$(document).ready(function (e) {
  $('body').on('submit', 'form', function(e){
        let id = $(this).closest('tr').attr('data-id');
		//console.log(getDate()); return false;
        let formData = new FormData(this);
        formData.append("id", id);
        formData.append("date", $(this).attr('data-date'));
    		e.preventDefault();
    		$.ajax({
          	url: "admin/upload.php",
    			type: "POST",
    			data:  formData,
    			contentType: false,
        		cache: false,
    			processData: false,
    			success: function(response)
    		    {
					if(response.status == 'success') {
						$('.alert-success').text(response.message).show();
					} else {
						$('.alert-danger').text(response.message).show();
					}
					setTimeout(function () {
					$('.alert').hide();
					}, 2000);
					// Load again page
					init(getDate());
    		    },
    		  	error: function(data)
    	    	{
    		  	  console.log("error");
    	    	}
    	   	});
         	return false;
    	});
    });

	function init(date) {
		let url = 'admin/members_list.php';
		$.ajax({
		type: "GET",
		url: url,
		data: {date},
		dataType  : 'json',
		success   : function(response) {
			if (response) { //If fails
				var text = '';
		var list = response.data;
		$.each(list, function(key, val) {
			let reason = '';
			let days = '';
			let content = '';
			let evidence = '';
			for(let i = 0; i < val.list_date.length; i++) {
				days += '<p>' + val.list_date[i] + '</p>';
				let prop = val.list_date[i].replace(/-/g, "");
				if(val.reason[i].indexOf('-') > -1) {
					reason += '<p></p>';
				} else {
					reason += '<p>' + val.reason[i] + '</p>';
				}
				if(val.content_list[i].indexOf('-') > -1) {
					content += '<p><button id="update_content" data-id="'+ val.id + '" data-date="'+ val.list_date[i] + '" type="button" class="btn btn-warning">Phạt</button></p>';
				} else {
					content += '<p>Đã phạt</p>';
				}

				if(val.evidence_list[i].indexOf('-') > -1) {
					evidence += '<form class="upload" data-date="'+ val.list_date[i] + '"><input type="file" title="" name="evidence" accept="image/png, image/gif, image/jpeg"/><input type="submit" value="Upload" class="btn btn-primary"></form>';
				} else {
					evidence += '<a href="uploads/'+ val.evidence_list[i] +'" target="_blank" class="btn btn-info">Evidence</a>';
				}
			}


			text += '<tr data-id="'+ val.id +'"><td>'+ (key+1) +'</td><td>' + val.text + '</td><td>'+ val.team + '</td><td>' + days + '</td><td>' + reason + '</td><td>';
			text += content;
			text += '</td><td>';
			text += evidence;
			text += '</td></tr>';
		})
		if(text == '') {
			text += '<tr><td colspan="5" style="text-align:center">Không có dữ liệu</td></tr>';
		}
		// Summary
		$(".total_user").text(response.summary.total_user);
		$(".total_evidence").text(response.summary.total_evidence);
		$('#list-table tbody tr').remove();
		$('#list-table tbody').append(text);
		} else {
					
				}
			}
		}).done(function(data){
		});
	}
	// Get selected date
	function getDate() {
		let date = $('#date').val();
		//return date;
		let registerdDate = (date.split("/"));
		return registerdDate[1]+'-'+registerdDate[0]+'-01';
	}
</script>
</body>
</html>
