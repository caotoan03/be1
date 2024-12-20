<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/categoryModal.php";

$categoryModal = new CategoryModal();

$maDanhMuc = isset($_GET['madanhmuc']) ? $_GET['madanhmuc'] : null;
$category = $categoryModal->getDetail($maDanhMuc);
$madanhmuc = !is_null($category) ? $category['madanhmuc'] : '';
$tendanhmuc = !is_null($category) ? $category['tendanhmuc'] : '';
$ghichu = !is_null($category) ? $category['ghichu'] : '';
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Cập Nhật Danh Mục</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<!------ Include the above in your HEAD tag ---------->




<!-- Form Name -->
<legend>Cập Nhật Danh Mục</legend>
<form class="form-horizontal" method="POST" action="xuly.php?madanhmuc=<?php echo $madanhmuc ?>">
  <div class="form-group">
    <div class="col-md-4 control-label">
      <a href="crud.php">&#8592; Quản lý danh mục</a>
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tensanpham">Tên danh mục</label>
    <div class="col-md-4">
      <input id="tendanhmuc" name="tendanhmuc" placeholder="Nhập tên danh mục" class="form-control input-md" required=""
        type="text" value="<?php echo $tendanhmuc ?>">
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="ghichu">Ghi chú</label>
    <div class="col-md-4">
      <textarea class="form-control input-md" name="ghichu" id="ghichu" cols="30"
        rows="10"><?php echo $ghichu ?></textarea>
    </div>
  </div>
  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="suadanhmuc">Sửa Danh Mục</label>
    <div class="col-md-4">
      <input type="submit" value="Sửa danh mục" name="suadanhmuc" class="btn btn-primary">
    </div>
  </div>
</form>