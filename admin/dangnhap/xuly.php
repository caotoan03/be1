<?php
session_start();
require_once "../../config/config.php";
require_once "../../modals/dbModal.php";
require_once "../../modals/accountModal.php";

$accountModal = new AccountModal();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $account = $accountModal->getLoginAccount($username, $password);
    if (is_null($account)) {
        echo '<script>
            alert("Chọn sai người dùng vui lòng chọn lại!")
            window.location.href = "dangnhap.php";
        </script>
        ';
    } else {
        if ($account['quyen'] != 'admin') {
            echo '<script>
                alert("Chọn sai người dùng vui lòng chọn lại!")
                window.location.href = "dangnhap.php";
            </script>
        ';
            die;
        }
        $_SESSION['admin_id'] = $account['id_account'];
        echo '<script>
        alert("Đăng nhập thành công, xin chào admin \'' . $account['email'] . '\'")
        window.location.href = "../index.php";
    </script>
    ';
        
    }
}


