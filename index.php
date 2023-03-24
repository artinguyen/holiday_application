<!DOCTYPE html>
<html lang="en">
<head>
  <title>[Web] Off-WFH-Late</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="favicon.png">
  <!-- Main css -->
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
    var reasons = 
      [ 
        {"name": "Nghỉ có phép"},
        {"name": "Work From Home"},
        {"name": "Đi trễ"}
      ];
  </script>
  <style>
    .alert {
      display: none;
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
      padding: 14px 17px;
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
    }
    .form-control{
      border: 0;
      border-radius: 0;
      border-bottom: 2px solid #ebebeb;
    }
    ul li:not(.init){
      display:block;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px;
    }
    .select2-container .select2-selection--single {
    height: 40px;
    }
    .select2-search input{
      margin-bottom: 0;
    }
    #reasons{
      margin-top: 31px;
    }
    #submit{
      float: left;
    }
    #list_view{
      float: right;
    }
    #note, #datepicker{
      padding-left: 10px;
    }
    </style>
</head>
<body>
<div class="main">
  <h1 style="text-align:center">OFF - WFH - LATE</h1>
  <div class="container">
      <form method="POST" class="appointment-form" id="appointment-form">
          <!-- <h2>đơn xin nghỉ</h2> -->
          <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-success">
              Gửi thành công
            </div>

            <div class="alert alert-danger">
              Không thể đăng ký
            </div>
          </div>
          </div>

          <div class="form-group">
              <div class="select-list">
                  <select name="course_type" id="list" class="form-control">
                    <option value=""></option>
                  </select>
              </div>
              <div class="select-list">
                  <select name="course_type" id="reasons" class="form-control">
                  <option value="">Lý do</option>
                  </select>
              </div>
              <input type="text" name="date" id="datepicker" placeholder="Ngày gửi" />
              <input type="text" name="note" id="note" placeholder="Ghi chú" />
          </div>
          <div class="form-submit">
              <input type="submit" name="submit" id="submit" class="submit" value="Gửi đơn" />
              <a id="list_view"href="list.php">Danh sách</a>
          </div>
      </form>
  </div>
</div>
<script>
$(document).ready(function(){
  // Date
  $( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy', minDate: 0}).datepicker("setDate", new Date());
  // Members
  $.getJSON("members_list.json", function(members){
  /*
    var text = '';
    $.each(members, function(key, val) {
    text += '<option>' + val.name + '</option>';
    })
  */

  if(getCookie('member_id') > 0) {
    $('#list').select2({
      placeholder: 'Họ và tên',
      data: members
    });
    $('#list').val(getCookie('member_id'));
    $("#list").select2().trigger('change');
  } else {
    $('#list').select2({
      placeholder: 'Họ và tên',
      data: members
    })
  }
 

  }).fail(function(){
      console.log("An error has occurred.");
  });

  // // Reasons
  var text = '';
  $.each(reasons, function(key, val) {
		text += '<option>' + val.name + '</option>';
	})
  $('#reasons').append(text);
  // // Create application
  $('body').on('click', '#submit', function(){
    let registerdDate = $('#datepicker').val();
    
    var id = $('#list option:selected').val();
    var name = $('#list option:selected').text();
    // Check validation
    if($('#list option:selected').val() == '') {
      id = getCookie('member_id');
    }
    if($('#list option:selected').text() == '') {
      name = getCookie('member_name');
    }
    let data = {
      'id' : id,
      'name' : name,
      'reason' : $('#reasons option:selected').val(),
      'date' : $('#datepicker').val(),
      'note' : $('#note').val()
    }
    $('.alert').css('display', 'none');
    if($('#list option:selected').text() == '' && getCookie('member_name') == '') {
      $('.alert-danger').css('display', 'block').text('Họ tên phải được chọn');
      return false;
    }
    // Check validation
    if($('#reasons option:selected').val() == '') {
      $('.alert-danger').css('display', 'block').text('Lý do phải được chọn');
      return false;
    }
    // Check validation
    if($('#datepicker').val() == '') {
      $('.alert-danger').css('display', 'block').text('Vui lòng chọn ngày');
      return false;
    }
    // Check validation
    if($('#reasons option:selected').val() == 'Đi trễ' && ($('#note').val()).trim() == '') {
      $('.alert-danger').css('display', 'block').text('Vui lòng điền thời gian bạn có mặt vào mục Ghi chú');
      return false;
    }
    $(this).attr('disabled', 'disabled');
    let self = this;
  	$.ajax({
      type: "POST",
      url: 'create.php',
      data: data,
      dataType  : 'json',
      success   : function(response) {
        $('.alert').hide();
        if(response.success) {
          $('.alert-success').show();
          $('#list').find('option:first').prop('selected', 'selected');
          $('#reasons').find('option:first').prop('selected', 'selected');
          $('#note').val('');
          // Store in cookie
          document.cookie = "member_id="+id;
          document.cookie = "member_name="+name;
        } else {
          $('.alert-danger').text(response.error).show();
        }
        setInterval(function () {
          $('.alert').hide();
        }, 1000);
        $(self).removeAttr('disabled');
      }
	  });
	  return false;
  })
}) // ./ Document


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
