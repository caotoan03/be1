<?php
class AccountModal extends DBModal
{
    /**
     * Lấy account user dựa vào đăng nhập
     * Nếu không tìm thấy hoặc có bất kỳ lỗi nào, trả về null
     */
    function getLoginAccount($email, $password)
    {
        try {
            // Nếu kết nối thất bại
            if (!self::$isConnectSuccess) return null;

            $sql = self::$connection->prepare("
                SELECT * 
                FROM account
                WHERE email = ? 
                    AND password = ?
                LIMIT 1
            ");
            $sql->bind_param("ss", $email, $password);

            // Thực thi câu lệnh
            $sql->execute();

            // Lấy kết quả dưới dạng mảng
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($items) > 0) return $items[0];
            return null;
        } catch (Exception $e) {
            // Nếu có bất kỳ lỗi gì
            return null;
        }
    }

    /**
     * Lấy account user theo id
     * Nếu không tìm thấy hoặc có bất kỳ lỗi nào, trả về null
     */
    function getAccountById($id)
    {
        try {
            // Nếu kết nối thất bại
            if (!self::$isConnectSuccess) return null;

            $sql = self::$connection->prepare("
                SELECT * 
                FROM account
                WHERE id_account = ?
                LIMIT 1
            ");
            $sql->bind_param("i", $id);

            // Thực thi câu lệnh
            $sql->execute();

            // Lấy kết quả dưới dạng mảng
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($items) > 0) return $items[0];
            return null;
        } catch (Exception $e) {
            // Nếu có bất kỳ lỗi gì
            return null;
        }
    }
}
