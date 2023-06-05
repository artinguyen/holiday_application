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
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<style>
	.tableContainer {
		max-height: 450px;
		overflow-y: auto;
	}
	.table, .summary {
		position: sticky;
		top: 0;
		width: 100%;
	}
	.table th, .summary th {
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
		color: #000;
		margin-bottom: 30px;
	}
	.summary td, .summary th{
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
	/* .ui-datepicker-calendar {
    	display: none;
	} */
	.modal-content {
		color: black;
	}
	.btn-info {
		width: 92px;
		margin-top: 2px;
		display: block;
	}
	.punish-text{
		background: red;
    	color: white;
		border-radius: 2px;
		padding: 10px;
		width: 70px;
		margin-top: 2px;
	}
	#list-table td p > button {
		vertical-align: unset;
		width: 70px;
	}
	.modal-body {
		text-align: center;
	}
	.evidence-col {
		margin-bottom: 2px;
	}
	.evidence-col a {
		float: left;
		margin-top: -1px;
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

			<div class="form-submit">
				<label for="date">Lọc theo họ tên:</label>
				<input id="name" type="text" onkeyup="filterName('')">
			</div>

		</div>
			<div class="tableContainer">
				<table class="table table-striped" id="list-table">
					<thead>
					<tr>
						<th>STT</th>
						<th style="width: 200px">Họ và tên</th>
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
	<hr>
	<div class="row">
	<div class="col-lg-6">
		<div class="tableContainer">
			<table class="summary col-lg-12" id="summary">
				<thead>
					<tr>
						<th>Họ và tên</th>
						<th>Team</th>
						<th>Ngày bị phạt</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
	<!-- <div class="col-lg-6">
		<a href="#" class="btn btn-info download_csv">Tải file thống kê theo tháng</a>
	</div> -->
	</div>

	<!-- Modal -->
	<div class="modal fade" id="confirmModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<!-- <h5 class="modal-title" id="confirmModalLabel">Modal title</h5> -->
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Bạn muốn phạt không?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="confirmed_update">OK</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
			</div>
		</div>
	</div>

</div>
<script>
$(document).ready(function(){
	$('#date').datepicker({
     changeMonth: true,
     changeYear: true,
     dateFormat: 'mm/yy',
	 maxDate: '0',
     onClose: function() {
        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
		init(getDate());
		initSummary();
     },
     beforeShow: function() {
       if ((selDate = $(this).val()).length > 0) 
       	{
			iYear = selDate.substring(selDate.length - 4, selDate.length);
			iMonth = (selDate.substring(0, selDate.length - 5) - 1);
			$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
			$(this).datepicker('setDate', new Date(iYear, iMonth, 1));
       	}
    },
	beforeShowDay:function(date){
     		return [false, ''];
  		},
  	}).datepicker( "setDate", new Date());

	// Update content
	$('body').on('click', '#update_content', function(){
		let name = '<b>' + $(this).closest('tr').find('td').eq(1).text() + '</b>';
		let date = '<b>' + $(this).attr('data-date') + '</b>';
		
		$('#confirmModal .modal-body').find('p').html('Bạn có muốn phạt ' + name + ' ngày ' + date + ' không?');
		$('#confirmModal').modal();
		// Reset data attribute
		$('#confirmed_update').removeAttr('data-type');
		$('#confirmed_update').attr('data-id', $(this).attr('data-id'));
		$('#confirmed_update').attr('data-date', $(this).attr('data-date'));
		return false;
	})

	// Delete content
	$('body').on('click', '#cancel_content', function(){
		let name = '<b>' + $(this).closest('tr').find('td').eq(1).text() + '</b>';
		let date = '<b>' + $(this).attr('data-date') + '</b>';
		//date = date.replace("-", "/");
		$('#confirmModal .modal-body').find('p').html('Bạn có muốn hủy phạt ' + name + ' ngày ' + date + ' không?');
		$('#confirmModal').modal();
		// Reset data attribute
		$('#confirmed_update').removeAttr('data-type');
		$('#confirmed_update').attr('data-id', $(this).attr('data-id'));
		$('#confirmed_update').attr('data-date', $(this).attr('data-date'));
		$('#confirmed_update').attr('data-type', 'cancel');
		return false;
	})

	// Delete evidence
	$('body').on('click', '#cancel_evidence', function(){
		let name = '<b>' + $(this).closest('tr').find('td').eq(1).text() + '</b>';
		let date = '<b>' + $(this).attr('data-date') + '</b>';
		//date = date.replace("-", "/");
		$('#confirmModal .modal-body').find('p').html('Bạn có muốn xóa evidence không ?');
		$('#confirmModal').modal();
		// Reset data attribute
		$('#confirmed_update').removeAttr('data-type');
		$('#confirmed_update').attr('data-id', $(this).attr('data-id'));
		$('#confirmed_update').attr('data-date', $(this).attr('data-date'));
		$('#confirmed_update').attr('data-type', 'evidence');
		return false;
	})

	$('body').on('click', '#confirmed_update', function(e){
		let id = $(this).attr('data-id');
		let date = $(this).attr('data-date');
		let url = 'admin/update_content.php';
		if($(this).attr('data-type') == 'cancel') {
			url = 'admin/cancel_content.php';
		}
		if($(this).attr('data-type') == 'evidence') {
			url = 'admin/cancel_evidence.php';
		}
		let self = this;
		$.ajax({
			type: "POST",
			url: url,
			data: {id, date},
			dataType  : 'json',
			success   : function(response) {
				if(response.success) {
					$('.alert-success').text(response.success).show();
					//$(self).closest('p').addClass('punish-text').text('Đã phạt');
					$('#confirmModal').modal('hide');
				} else {
					$('.alert-danger').text(response.error).show();
				}
				setTimeout(function () {
				$('.alert').hide();
				}, 2000);
				// Load again page
				init(getDate(), true);
				initSummary();	
			}
		}).done(function(data){
			
		});
		return false;
	})


	$('input[type=radio][name=filter]').change(function() {
		filter(this.value);
	});

   	// Init
   	init('');
	// Init summary
	initSummary();
   	// Download csv
   	$('.download_csv').click(function(){
		window.location.href = 'admin/download_csv.php?date='+getDate();
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

	// Summary table
	table = document.getElementById("summary");
	tr = table.getElementsByTagName("tr");
	// Loop through all table rows, and hide those who don't match the search query
	for (i = 0; i < tr.length; i++) {
		if(name == 'BE' || name == 'FE') {
		td = tr[i].getElementsByTagName("td")[1];
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
	if($('#summary tbody tr:visible').length == 0) {
		$('#summary tbody').append('<tr class="no-data"><td colspan="4" style="text-align:center; background-color: rgba(0,0,0,.05);">Không có dữ liệu</td></tr>');
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
					filter();
					if($('#name').val('') != '') {
						filterName();
					}
    		    },
    		  	error: function(data)
    	    	{
    		  	  console.log("error");
    	    	}
    	   	});
         	return false;
    	});

		$('body').on('change', 'input[type="file"]', function(e){
			$(this).parent().find('input[type="submit"]').show();
		});
    });

	function init(date, search ) {
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
					content += '<p><span class="punish-text">Đã phạt</span> / <button id="cancel_content" data-id="'+ val.id + '" data-date="'+ val.list_date[i] + '" type="button" class="btn btn-success">Hủy</button></p>';
				}

				if(val.evidence_list[i].indexOf('-') > -1) {
					evidence += '<form class="upload" data-date="'+ val.list_date[i] + '"><input type="file" title="" name="evidence" accept="image/png, image/gif, image/jpeg"/><input type="submit" value="Upload" class="btn btn-primary" style="display:none"></form>';
				} else {
					evidence += '<div class="evidence-col"><a href="uploads/'+ val.evidence_list[i] +'" target="_blank" class="btn btn-info">Evidence</a> ';
					evidence += '&nbsp;/&nbsp;<button id="cancel_evidence" data-id="'+ val.id + '" data-date="'+ val.list_date[i] + '" type="button" class="btn btn-success">Hủy</button></div>';
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
			if($('#name').val() != '' && search === true) {
				filterName($('#name').val());
			} else {
				if($('input[type=radio][name=filter]:checked').val() != '' && $('input[type=radio][name=filter]:checked').val() !== undefined  && search === true) {
					filter( $('input[type=radio][name=filter]:checked').val() );
				}
			}
		});
	}
	// Get selected date
	function getDate() {
		let date = $('#date').val();
		let registerdDate = (date.split("/"));
		return registerdDate[1]+'-'+registerdDate[0]+'-01';
	}
	
	function filterName(name) {
		$('input[name="filter"]').prop('checked', false);
		// Declare variables
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("name");
		if(name != '') {
			input.value = name;
		}
		
		filter = input.value.toUpperCase();
		table = document.getElementById("list-table");
		tr = table.getElementsByTagName("tr");

		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[1];
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
			$('#list-table tbody').append('<tr class="no-data"><td colspan="7" style="text-align:center; background-color: rgba(0,0,0,.05);">Không có dữ liệu</td></tr>');
		}

		// Summary table
		table = document.getElementById("summary");
		tr = table.getElementsByTagName("tr");
		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
			txtValue = td.textContent || td.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
			}
		}
		if($('#summary tbody tr:visible').length == 0) {
			$('#summary tbody').append('<tr class="no-data"><td colspan="4" style="text-align:center; background-color: rgba(0,0,0,.05);">Không có dữ liệu</td></tr>');
		}
	}

	function initSummary() {
		let url = 'admin/summary.php';
		$.ajax({
		type: "GET",
		url: url,
		data: {date : getDate()},
		dataType  : 'json',
		success   : function(response) {
			if (response) { //If fails
				var text = '';
				var list = response.data;
				$.each(list, function(key, val) {
					let dates = val.content;
					let dateCol = '<td>';
					for(var key in dates){
						dateCol += '<p>' + dates[key] + '</p>';
					}
					dateCol += '</td>';
					text += '<tr><td>' + val.text + '</td><td>'+ val.team + '</td>' + dateCol + '<td>' + (Object.values(dates).length * 10000) + '</td></tr>';
				})
				if(text == '') {
					text += '<tr><td colspan="4" style="text-align:center">Không có dữ liệu</td></tr>';
				}
				//Summary
				$('.summary tbody tr').remove();
				$('.summary tbody').append(text);
			}
		}
		}).done(function(data){

		});
	}

</script>

</body>
</html>
