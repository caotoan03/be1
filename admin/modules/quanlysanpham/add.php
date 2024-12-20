<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/categoryModal.php";
require_once "../../../modals/categoryByProducerModal.php";

$categoryModal = new CategoryModal();
$producerModal = new categoryByProducerModal();

$categories = $categoryModal->getAll();
$producers = $producerModal->getAll();
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Thêm sản phẩm</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<!------ Include the above in your HEAD tag ---------->



<!-- Form Name -->
<legend>Thêm sản phẩm</legend>

<form class="form-horizontal" action="xuly.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-md-4 control-label">
      <a href="crud.php">&#8592; Quản lý sản phẩm</a>
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="masanpham">Mã sản phẩm</label>
    <div class="col-md-4">
      <input id="masanpham" name="masanpham" placeholder="Nhập mã sản phẩm" class="form-control input-md" required="" type="text">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tensanpham">Tên sản phẩm</label>
    <div class="col-md-4">
      <input id="tensanpham" name="tensanpham" placeholder="Nhập tên sản phẩm" class="form-control input-md" required="" type="text">
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="giasanpham">Giá</label>
    <div class="col-md-4">
      <input id="giasanpham" name="giasanpham" placeholder="Nhập số tiền" class="form-control input-md" required="" type="text">
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="motasanpham">Mô tả sản phẩm</label>
    <div class="col-md-4">
      <textarea class="form-control input-md" name="motasanpham" id="motasanpham" cols="30" rows="10"></textarea>
    </div>
  </div>
  <!-- Select input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="danhmuc">Danh Mục</label>
    <div class="col-md-4">
      <select name="danhmuc">
        <?php foreach ($categories as $item) { ?>
          <option value="<?php echo $item['madanhmuc'] ?>"><?php echo $item['tendanhmuc'] ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <!-- Select input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="hang">Hãng</label>
    <div class="col-md-4">
      <select name="hang">
        <?php foreach ($producers as $item) { ?>
          <option value="<?php echo $item['maproducer'] ?>"><?php echo $item['tenproducer'] ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <!-- File Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="hinhanh">Ảnh sản phẩm</label>
    <div class="col-md-4">
      <input id="hinhanh" name="hinhanh" class="input-file" type="file">
    </div>
  </div>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="labelthemsanpham">Thêm Sản Phẩm</label>
    <div class="col-md-4">
      <input type="submit" value="Thêm sản phẩm" name="themsanpham" class="btn btn-primary">
    </div>
  </div>
</form>