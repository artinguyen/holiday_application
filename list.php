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
  th {
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
  </style>
</head>
<body>
<h1 style="text-align:center">OFF - WFH - LATE</h1>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
    <h2>Danh sách đơn xin phép</h2>
    <div class="form-group">
      <div class="alert alert-danger" style="display:none">
              Ngày không hợp lệ
            </div>
      <label for="date">Từ ngày:</label>
      <input id="date_from" type="text">

      <label for="date">Đến ngày:</label>
      <!-- <select id="type" name="type">
        <option value="day">Ngày</option>
        <option value="week">Tuần</option>
        <option value="month">Tháng</option>
      </select> -->
      <input id="date_to" type="text">
      <div class="form-submit">
        <label for="date">Lọc theo họ tên:</label>
        <input id="name" type="text" onkeyup="filter('')">    
      </div>
      <div class="form-submit">
        <a id="list_view"href="index.php">Trở về trang trước</a>
      </div>
    </div>
      <div class="tableContainer">
      
      <table class="table table-striped" id="list-table">
        <thead>
          <tr>
            <th>Họ và tên</th>
            <th>Lý do</th>
            <th>Ghi chú</th>
            <th>Thời gian gửi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      </div>
      
    </div>
    
  </div>
</div>
<script>
$(document).ready(function(){
  // $( "#date_from" ).datepicker({
  //     dateFormat: 'dd/mm/yy',
  //     onClose: function( selectedDate ) {
  //       $( "#date_to" ).datepicker( "option", "minDate", selectedDate );
  //     }
  //   });
  //   $( "#date_to" ).datepicker({
  //     dateFormat: 'dd/mm/yy',
  //     onClose: function( selectedDate ) {
  //       $( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
  //     }
  //   });
  $( "#date_from, #date_to" ).datepicker({ dateFormat: 'dd/mm/yy'}).on("change", function() {

    
    
    // let registerdDate = $('#datepicker').val();
    // registerdDate = (registerdDate.split("/"));
    // let date = registerdDate[2]+'/'+registerdDate[1]+'/'+registerdDate[0];
    // let type = $('#type option:selected').val();
    let date_from = $('#date_from').val();
    let date_to = $('#date_to').val();
    let registerdDate1 = (date_from.split("/"));
    let registerdDate2 = (date_to.split("/"));
    let date1 = registerdDate1[2]+'-'+registerdDate1[1]+'-'+registerdDate1[0];
    let date2 = registerdDate2[2]+'-'+registerdDate2[1]+'-'+registerdDate2[0];
    const d1 = new Date(date1);
    const d2 = new Date(date2);
    //console.log(date1, date2);
    if(d2 < d1) {
      $('.alert-danger').show();
      setInterval(function () {
          $('.alert').hide();
        }, 2000);
      return false;
    }

    $.ajax({
    type: "GET",
    url: 'registered_list.php?date_from='+date_from+'&date_to='+date_to,
    data: {},
    dataType  : 'json',
    success   : function(response) {
      if (response) { //If fails
        var text = '';
        var list = response.data;
        $.each(response, function(key, val) {
          text += '<tr><td>' + val.name + '</td><td>' + val.reason + '</td><td>' + val.note + '</td><td>' + val.date + '</td></tr>';
          })
        if(text == '') {
          text += '<tr><td colspan="4" style="text-align:center">Không có dữ liệu</td></tr>';
        }
        $('tbody tr').remove();
        $('tbody').append(text);
            }
      else {
          
        }
      }
    }).done(function(data){
      filter(getCookie('member_name'));
    });
  }).datepicker("setDate", new Date());

  var utc = new Date().toJSON().slice(0,10).replace(/-/g,'');
  $.ajax({
    type: "GET",
    url: 'registered_list.php?date_from=&date_to=',
    data: {date : ''},
    dataType  : 'json',
	success   : function(response) {
		if (response) { //If fails
			var text = '';
      var list = response.data;
      $.each(response, function(key, val) {
		    text += '<tr><td>' + val.name + '</td><td>' + val.reason + '</td><td>' + val.note + '</td><td>' + val.date + '</td></tr>';
      })
      if(text == '') {
        text += '<tr><td colspan="4" style="text-align:center">Không có dữ liệu</td></tr>';
      }
        $('tbody tr').remove();
        $('tbody').append(text);
    } else {
				
			}
		}
	}).done(function(data){

    filter(getCookie('member_name'));

});

}) // ./ Document

function filter(name) {
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
  $(".no-data").remove();
  if($('#list-table tbody tr:visible').length == 0) {
    $('#list-table tbody').append('<tr class="no-data"><td colspan="4" style="text-align:center; background-color: rgba(0,0,0,.05);">Không có dữ liệu</td></tr>');
  }
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
</script>
</body>
</html>
