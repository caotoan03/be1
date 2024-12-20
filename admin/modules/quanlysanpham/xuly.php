<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/productModal.php";

$productModal = new ProductModal();

$idproduct = isset($_GET['idproduct']) ? $_GET['idproduct'] : '';
$masanpham = isset($_POST['masanpham']) ? $_POST['masanpham'] : '';
$tensanpham = isset($_POST['tensanpham']) ? $_POST['tensanpham'] : '';
$gia = isset($_POST['giasanpham']) ? $_POST['giasanpham'] : '';
$mota = isset($_POST['motasanpham']) ? $_POST['motasanpham'] : '';
$madanhmuc = isset($_POST['danhmuc']) ? $_POST['danhmuc'] : '';
$maproducer = isset($_POST['hang']) ? $_POST['hang'] : '';

$hinhanh = isset($_FILES['hinhanh']) ? $_FILES['hinhanh']['name'] : '';
$hinhanh_tmp = isset($_FILES['hinhanh']) ? $_FILES['hinhanh']['tmp_name'] : '';
$thoi_gian_hien_tai = time();
if (!empty($hinhanh)) $hinhanh = $thoi_gian_hien_tai . $hinhanh;

$isUpdateImage = !empty($hinhanh);

$oldProduct = $productModal->getProductDetail($idproduct);
$oldProductHinh = !is_null($oldProduct) ? $oldProduct['hinh'] : '';

if (isset($_POST['themsanpham'])) {
    $ketQua = $productModal->add($masanpham, $tensanpham, $gia, $mota, $hinhanh, $madanhmuc, $maproducer);
    if ($ketQua == true && $hinhanh != "") {
        move_uploaded_file($hinhanh_tmp, 'images/' . $hinhanh);
    }
} else if (isset($_POST['suasanpham'])) {
    $ketQua = $productModal->update($idproduct, $masanpham, $tensanpham, $gia, $mota, $hinhanh, $madanhmuc, $maproducer, $isUpdateImage);
    if ($ketQua == true) {
        // Xóa hình ảnh cũ
        if ($oldProductHinh != '') {
            unlink('images/' . $oldProductHinh['hinh']);
        }
        // Thêm hình ảnh mới
        if ($hinhanh != "") {
            move_uploaded_file($hinhanh_tmp, 'images/' . $hinhanh);
        }
    }
} else {
    $ketQua = $productModal->delete($idproduct);
    if ($ketQua == true) {
        // Xóa hình ảnh cũ
        if ($oldProductHinh != '') {
            unlink('images/' . $oldProductHinh['hinh']);
        }
    }
}
header('Location:crud.php');

