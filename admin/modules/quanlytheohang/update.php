<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/categoryByProducerModal.php";

$producerModal = new CategoryByProducerModal();

$maproducer = isset($_GET['maproducer']) ? $_GET['maproducer'] : null;
$producer = $producerModal->getDetail($maproducer);
$maproducer = !is_null($producer) ? $producer['maproducer'] : '';
$tenproducer = !is_null($producer) ? $producer['tenproducer'] : '';
$ghichu = !is_null($producer) ? $producer['ghichu'] : '';
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Cập nhật hãng</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<!------ Include the above in your HEAD tag ---------->




<!-- Form Name -->
<legend>Cập nhật hãng</legend>
<form class="form-horizontal" method="POST" action="xuly.php?maproducer=<?php echo $maproducer ?>">
  <div class="form-group">
    <div class="col-md-4 control-label">
      <a href="crud.php">&#8592; Quản lý hãng</a>
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tensanpham">Tên danh mục</label>
    <div class="col-md-4">
      <input id="tenproducer" name="tenproducer" placeholder="Nhập tên danh mục hãng" class="form-control input-md" required=""
        type="text" value="<?php echo $tenproducer ?>">
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
    <label class="col-md-4 control-label" for="suadanhmuchang">Sửa Danh Mục Hãng</label>
    <div class="col-md-4">
      <input type="submit" value="Sửa danh mục hãng" name="suadanhmuchang" class="btn btn-primary">
    </div>
  </div>
</form>