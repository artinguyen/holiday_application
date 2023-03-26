<?php 
$auth = false;
if( isset($_GET['user']) && isset($_GET['pass']) ) {
  if($_GET['user'] == 'admin' && $_GET['pass'] == 'vlDQNrLVOz') {
  $auth = true;  
 }
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
  #staticBackdrop input, #staticBackdrop select {
    width: 100%;
    /* border: 1px solid black; */
  }
  #staticBackdrop select {
    appearance: auto !important;
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
      <div class="alert alert-success" style="display:none">
              Gửi thành công
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
            <th colspan="2"></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      </div>
      
    </div>
    
  </div>
</div>


<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <select class="form-control" id="reason" name="reason">
        <option value="OFF">Nghỉ có phép</option>
        <option value="WFH">Work From Home</option>
        <option value="LATE">Đi trễ</option>
      </select>
        <input class="form-control" type="text" name="note" id="note" placeholder="Ghi chú" />
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" id="update">Cập nhật</button>
      </div>
    </div>
  </div>
</div>









<script>
  var auth = "<?php echo $auth; ?>";
 
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
          if(auth) {
            text += '<tr data-id="'+ val.id +'" data-date="'+ val.date +'"><td>' + val.name + '</td><td>' + val.reason + '</td><td>' + val.note + '</td><td>' + val.date + '</td><td><button id="edit" type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-primary">Sửa</button></td><td><button id="delete" type="button" class="btn btn-primary">Xóa</button></tr>';
          } else {
            text += '<tr data-id="'+ val.id +'" data-date="'+ val.date +'"><td>' + val.name + '</td><td>' + val.reason + '</td><td>' + val.note + '</td><td>' + val.date + '</td></tr>';
          }
          
          })
        if(text == '' && auth) {
          text += '<tr><td colspan="6" style="text-align:center">Không có dữ liệu</td></tr>';
        } 
        if(text == '' && !auth) {
          text += '<tr><td colspan="4" style="text-align:center">Không có dữ liệu</td></tr>';
        }
        $('tbody tr').remove();
        $('tbody').append(text);
            }
      else {
          
        }
      }
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
          if(auth) {
            text += '<tr data-id="'+ val.id +'" data-date="'+ val.date +'"><td>' + val.name + '</td><td>' + val.reason + '</td><td>' + val.note + '</td><td>' + val.date + '</td><td><button id="edit" type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-primary">Sửa</button></td><td><button id="delete" type="button" class="btn btn-primary">Xóa</button></tr>';
          } else {
            text += '<tr data-id="'+ val.id +'" data-date="'+ val.date +'"><td>' + val.name + '</td><td>' + val.reason + '</td><td>' + val.note + '</td><td>' + val.date + '</td></tr>';
          }
          
          })
        if(text == '' && auth) {
          text += '<tr><td colspan="6" style="text-align:center">Không có dữ liệu</td></tr>';
        } 
        if(text == '' && !auth) {
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

// Delete record
$('body').on('click', '#delete', function(){
let id = $(this).closest('tr').attr('data-id');
let date = $(this).closest('tr').attr('data-date');
let self = $(this);
$.ajax({
      type: "POST",
      url: 'crud.php',
      data: {id, date, action : 'delete'},
      dataType  : 'json',
      success   : function(response) {
        // $('.alert').hide();
        // if(response.success) {
        //   $('.alert-success').show();
        //   $('#list').find('option:first').prop('selected', 'selected');
        //   $('#reasons').find('option:first').prop('selected', 'selected');
        //   $('#note').val('');
        //   // Store in cookie
        //   document.cookie = "member_id="+id;
        //   document.cookie = "member_name="+name;
        // } else {
        //   $('.alert-danger').text(response.error).show();
        // }
        // setTimeout(function () {
        //   $('.alert').hide();
        // }, 2000);
        // $(self).removeAttr('disabled');
        if(response.success) {
          $('.alert-success').text(response.success).show();
          $(self).closest('tr').remove();
        }
      }
	  });
})



// Update record
$('body').on('click', '#update', function(){
  // $("#myModal").modal();
  // return false;
let id = $(this).attr('data-id');
let reason = $('#reason option:selected').text();
let val_reason = $('#reason option:selected').val();
let note = $('#note').val();
let date = $(this).attr('data-date');
let self = $(this);
//$('#staticBackdrop').modal('hide');
//$('.modal-backdrop').remove();
//$(".modal-backdrop").remove();
$('.close').click(); 
$.ajax({
      type: "POST",
      url: 'crud.php',
      data: {id, reason, note, date, action : 'update'},
      dataType  : 'json',
      success   : function(response) {
        // $('.alert').hide();
        // if(response.success) {
        //   $('.alert-success').show();
        //   $('#list').find('option:first').prop('selected', 'selected');
        //   $('#reasons').find('option:first').prop('selected', 'selected');
        //   $('#note').val('');
        //   // Store in cookie
        //   document.cookie = "member_id="+id;
        //   document.cookie = "member_name="+name;
        // } else {
        //   $('.alert-danger').text(response.error).show();
        // }
        // setTimeout(function () {
        //   $('.alert').hide();
        // }, 2000);
        // $(self).removeAttr('disabled');
        if(response.success) {
          $('.alert-success').text(response.success).show();
          setTimeout(function () {
            $('.alert').hide();
          }, 2000);

          $('tr').each(function(index){
            if($(this).attr('data-id') == id) {

              $(this).find('td').eq(1).text(val_reason);
              $(this).find('td').eq(2).text(note);
              return false;
            }

          })

        }
        
      }
	  });
})

// Delete record
$('body').on('click', '#edit', function(){
  // $("#myModal").modal();
  // return false;
  let id = $(this).closest('tr').attr('data-id');
let reason = $(this).closest('tr').find('td').eq(1).text();
let note = $(this).closest('tr').find('td').eq(2).text();
if(reason == 'OFF') {
  $('#reason').val('OFF').change();
}
if(reason == 'WFH') {
  $('#reason').val('WFH').change();
}
if(reason == 'LATE') {
  $('#reason').val('LATE').change();
}
let date = $(this).closest('tr').attr('data-date');
$('#note').val(note);
$('#update').attr('data-id', id);
$('#update').attr('data-date', date);
})


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
  console.log($('#list-table tbody tr:visible').length);
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
