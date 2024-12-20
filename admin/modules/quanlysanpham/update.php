<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/productModal.php";
require_once "../../../modals/categoryModal.php";
require_once "../../../modals/categoryByProducerModal.php";

$productModal = new ProductModal();
$categoryModal = new CategoryModal();
$producerModal = new categoryByProducerModal();

$categories = $categoryModal->getAll();
$producers = $producerModal->getAll();

$idproduct = isset($_GET['idproduct']) ? $_GET['idproduct'] : null;
$productDetail = $productModal->getProductDetail($idproduct);

$id_product = !is_null($productDetail) ? $productDetail['id_product'] : '';
$masanpham = !is_null($productDetail) ? $productDetail['masanpham'] : '';
$tensanpham = !is_null($productDetail) ? $productDetail['tensanpham'] : '';
$gia = !is_null($productDetail) ? $productDetail['gia'] : '';
$mota = !is_null($productDetail) ? $productDetail['mota'] : '';
$hinh = !is_null($productDetail) && !empty($productDetail['hinh']) ? $productDetail['hinh'] : $imageComingSoon;
$madanhmuc = !is_null($productDetail) ? $productDetail['madanhmuc'] : '';
$maproducer = !is_null($productDetail) ? $productDetail['maproducer'] : '';

?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Update sản phẩm</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<!------ Include the above in your HEAD tag ---------->

<!-- Form Name -->
<legend>Update Sản phẩm</legend>
<?php
if (!is_null($productDetail)) {
?>
  <form class="form-horizontal" method="POST" action="xuly.php?idproduct=<?php echo $id_product ?>"
    enctype="multipart/form-data">
    <div class="form-group">
      <div class="col-md-4 control-label">
        <a href="crud.php">&#8592; Quản lý sản phẩm</a>
      </div>
    </div>
    <!-- Text input-->

    <div class="form-group">
      <label class="col-md-4 control-label" for="masanpham">Mã sản phẩm</label>
      <div class="col-md-4">
        <input id="masanpham" name="masanpham" placeholder="Nhập mã sản phẩm" class="form-control input-md" required=""
          type="text" value="<?php echo $masanpham ?>">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="tensanpham">Tên sản phẩm</label>
      <div class="col-md-4">
        <input id="tensanpham" name="tensanpham" placeholder="Nhập tên sản phẩm" class="form-control input-md" required=""
          type="text" value="<?php echo $tensanpham ?>">
      </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="giasanpham">Giá</label>
      <div class="col-md-4">
        <input id="giasanpham" name="giasanpham" placeholder="Nhập số tiền" class="form-control input-md" required=""
          type="text" value="<?php echo $gia ?>">

      </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="motasanpham">Mô tả sản phẩm</label>
      <div class="col-md-4">
        <textarea class="form-control input-md" name="motasanpham" id="motasanpham" cols="30"
          rows="10"><?php echo $mota ?></textarea>
      </div>
    </div>
    <!-- Select input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="danhmuc">Danh Mục</label>
      <div class="col-md-4">
        <select name="danhmuc">
          <?php foreach ($categories as $item) { ?>
            <option
              value="<?php echo $item['madanhmuc'] ?>"
              <?php
              if ($item['madanhmuc'] == $madanhmuc) echo 'selected'
              ?>><?php echo $item['tendanhmuc'] ?></option>
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
            <option
              value="<?php echo $item['maproducer'] ?>"
              <?php
              if ($item['maproducer'] == $maproducer) echo 'selected'
              ?>><?php echo $item['tenproducer'] ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <!-- File Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="fileanh">Ảnh sản phẩm</label>
      <div class="col-md-4">
        <input id="input-hinh" name="hinhanh" class="input-file" type="file" accept="image/*">
        <img id="img-hinh" src="images/<?php echo $hinh ?> " width="100px">
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="suasanpham">Sửa Sản Phẩm</label>
      <div class="col-md-4">
        <input type="submit" value="Sửa sản phẩm" name="suasanpham" class="btn btn-primary">
      </div>
    </div>
  </form>

  <script>
    const imageComingSoon = "images/product-coming-soon.jpg";
    const inputHinh = document.getElementById('input-hinh');
    const imgHinh = document.getElementById('img-hinh');

    inputHinh.addEventListener('change', function(event) {
      const file = event.target.files[0];

      if (file) {
        // Kiểm tra xem tệp có phải là hình ảnh không
        if (file.type.startsWith('image/')) {
          const reader = new FileReader();

          reader.onload = function(e) {
            imgHinh.src = e.target.result;
          }

          reader.readAsDataURL(file); // Đọc file dưới dạng Data URL
        } else {
          imgHinh.src = imageComingSoon;
          event.target.value = '';
        }
      } else {
        imgHinh.src = imageComingSoon;
      }
    });
  </script>
<?php
}
?>