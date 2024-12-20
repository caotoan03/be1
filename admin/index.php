<?php
// Check Login
session_start();
require_once "../config/config.php";
require_once "../modals/dbModal.php";
require_once "../modals/accountModal.php";

$accountModal = new AccountModal();

function processWhenNotFoundUser()
{
    echo '<script>
        alert("Đã có lỗi xảy ra, vui lòng đăng nhập lại!")
        window.location.href = "dangnhap/dangnhap.php";
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="menu.css">
</head>

<body>

    <h1>Welcome Admin "<?= $userInfo['email'] ?>"</h1>
    <i class="btn-dang-xuat">Đăng xuất</i>
    <nav>
        <ul>
            <li><a href="../admin/modules/quanlysanpham/crud.php" title="Quản Lý Sản Phẩm">Quản Lý Sản Phẩm</a></li>
            <li><a href="../admin/modules/quanlydanhmuc/crud.php" title="Quản Lý Danh Mục">Quản Lý Danh Mục</a></li>
            <li><a href="../admin/modules/quanlytheohang/crud.php" title="Quản Lý Theo Hãng">Quản Lý Theo Hãng</a></li>
        </ul>
    </nav>
</body>

</html>

<script>
    document.querySelector('.btn-dang-xuat').onclick = () => {
        if (confirm("Bạn có chắc chắn luôn đăng xuất ?")) {
            window.location.href = "logout.php";
        }
    }
</script>