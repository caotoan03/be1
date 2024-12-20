<?php
require_once "../__checkUser.php";
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Thêm nhật hãng</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<!------ Include the above in your HEAD tag ---------->



<!-- Form Name -->
<legend>Thêm hãng</legend>

<form class="form-horizontal" action="xuly.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-md-4 control-label">
      <a href="crud.php">&#8592; Quản lý hãng</a>
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tenhang">Tên hãng</label>
    <div class="col-md-4">
      <input id="tendanhmuc" name="tenproducer" placeholder="Nhập tên danh mục" class="form-control input-md" required="" type="text">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="ghichu">Ghi chú</label>
    <div class="col-md-4">
      <textarea class="form-control input-md" name="ghichu" id="ghichu" cols="30" rows="10"></textarea>
    </div>
  </div>


  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="labelthemdanhmuc">Thêm Danh Mục Hãng</label>
    <div class="col-md-4">
      <input type="submit" value="Thêm danh mục hãng" name="themdanhmuchang" class="btn btn-primary">
    </div>
  </div>
</form>