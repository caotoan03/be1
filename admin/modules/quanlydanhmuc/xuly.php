<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/categoryModal.php";

$categoryModal = new CategoryModal();

$madanhmuc = isset($_GET['madanhmuc']) ? $_GET['madanhmuc'] : '';
$tendanhmuc = isset($_POST['tendanhmuc']) ? $_POST['tendanhmuc'] : '';
$ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';

if (isset($_POST['themdanhmuc'])) {
    $categoryModal->add($tendanhmuc, $ghichu);
} else if (isset($_POST['suadanhmuc'])) {
    $categoryModal->update($madanhmuc, $tendanhmuc, $ghichu);
} else {
    $categoryModal->delete($madanhmuc);
}
header('Location:crud.php');
