<?php

class CategoryModal extends DBModal
{
    /**
     * Lấy tất cả category
     */
    function getAll()
    {
        try {
            // Nếu kết nối thất bại, trả về mảng rỗng
            if (!self::$isConnectSuccess) return [];

            $sql = self::$connection->prepare("SELECT * FROM category ORDER BY madanhmuc DESC");

            // Thực thi câu lệnh
            $sql->execute();

            // Lấy kết quả và trả về dưới dạng mảng
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            return $items;
        } catch (Exception $e) {
            // Nếu có bất kỳ lỗi gì, trả về mảng rỗng
            return [];
        }
    }


    /**
     * Lấy chi tiết 1 Category
     */
    function getDetail($cate_id)
    {
        try {
            // Nếu kết nối thất bại
            if (!self::$isConnectSuccess) return null;

            $sql = self::$connection->prepare("SELECT * FROM category WHERE madanhmuc = ? LIMIT 1");
            $sql->bind_param("i", $cate_id);

            // Thực thi câu lệnh
            $sql->execute();

            // Lấy kết quả dưới dạng mảng
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($items) > 0) return $items[0];
            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Thêm 1 category
     * True nếu thêm thành công và ngược lại
     */
    function add($ten, $ghiChu)
    {
        try {
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                INSERT INTO category(`tendanhmuc`, `ghichu`) 
                VALUE (?, ?)
            ");
            $sql->bind_param("ss", $ten, $ghiChu);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Cập nhật 1 category
     * True nếu cập nhật thành công và ngược lại
     */
    function update($id, $ten, $ghiChu)
    {
        try {
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                UPDATE category
                SET tendanhmuc = ?,
                    ghichu = ?
                WHERE madanhmuc = ?
            ");
            $sql->bind_param("ssi", $ten, $ghiChu, $id);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Xóa 1 category
     * True nếu xóa thành công và ngược lại
     */
    function delete($id)
    {
        try {
            if (!self::$isConnectSuccess) return false;
            $checkProduct = $this->checkHasProduct($id);
            if ($checkProduct) return false;

            $sql = self::$connection->prepare("
                DELETE
                FROM category
                WHERE madanhmuc = ?
            ");
            $sql->bind_param("i", $id);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Xóa tất cả category
     * True nếu xóa thành công và ngược lại
     */
    function deleteAll()
    {
        try {
            if (!self::$isConnectSuccess) return false;
            $all = $this->getAll();
            foreach($all as $item) {
                $this->delete($item['madanhmuc']);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Kiểm tra xem category hiện tại có product hay không
     */
    function checkHasProduct($cate_id)
    {
        try {
            // Nếu kết nối thất bại
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                SELECT * 
                FROM products
                WHERE madanhmuc = ?
                LIMIT 1
            ");
            $sql->bind_param("i", $cate_id);

            // Thực thi câu lệnh
            $sql->execute();

            // Lấy kết quả dưới dạng mảng
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            return count($items) > 0;
        } catch (Exception $e) {
            return false;
        }
    }
}
