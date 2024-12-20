<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/categoryByProducerModal.php";

$producerModal = new CategoryByProducerModal();

$maproducer = isset($_GET['maproducer']) ? $_GET['maproducer'] : '';
$tenproducer = isset($_POST['tenproducer']) ? $_POST['tenproducer'] : '';
$ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';

if (isset($_POST['themdanhmuchang'])) {
    $producerModal->add($tenproducer, $ghichu);
} else if (isset($_POST['suadanhmuchang'])) {
    $producerModal->update($maproducer, $tenproducer, $ghichu);
} else {
    $producerModal->delete($maproducer);
}
header('Location:crud.php');