<?php 
// Check Login
session_start();
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/accountModal.php";

$accountModal = new AccountModal();

function processWhenNotFoundUser()
{
    echo '<script>
        alert("Đã có lỗi xảy ra, vui lòng đăng nhập lại!")
        window.location.href = "../../dangnhap/dangnhap.php";
    </script>';
}

if (!isset($_SESSION['admin_id'])) {
    processWhenNotFoundUser();
    die;
} else {
    $userInfo = $accountModal->getAccountById($_SESSION['admin_id']);
    if (
        is_null($userInfo) ||
        $userInfo['quyen']  != 'admin'
    ) {
        processWhenNotFoundUser();
        die;
    }
}

$imageComingSoon = 'product-coming-soon.jpg';