<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/productModal.php";

$productModal = new ProductModal();

$success = $productModal->deleteAll();

if ($success) {
    $directory = 'images/';

    $files = array_diff(scandir($directory), array('.', '..', $imageComingSoon));

    foreach ($files as $file) {
        $filePath = $directory . DIRECTORY_SEPARATOR . $file;
        if (is_file($filePath)) {
            unlink($filePath);
        }
    }
}

header('Location:crud.php');
?>