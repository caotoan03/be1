<?php

class CategoryByProducerModal extends DBModal
{
    /**
     * Lấy tất cả CategoryByProducerModal
     */
    function getAll()
    {
        try {
            // Nếu kết nối thất bại, trả về mảng rỗng
            if (!self::$isConnectSuccess) return [];

            $sql = self::$connection->prepare("SELECT * FROM categorybyproducer ORDER BY maproducer DESC");

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
     * Lấy chi tiết 1 Producer
     */
    function getDetail($id)
    {
        try {
            // Nếu kết nối thất bại
            if (!self::$isConnectSuccess) return null;

            $sql = self::$connection->prepare("SELECT * FROM `categorybyproducer` WHERE maproducer  = ? LIMIT 1");
            $sql->bind_param("i", $id);

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
     * Thêm 1 Producer
     * True nếu thêm thành công và ngược lại
     */
    function add($ten, $ghiChu)
    {
        try {
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                INSERT INTO categorybyproducer(`tenproducer`, `ghichu`) 
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
     * Cập nhật 1 Producer
     * True nếu cập nhật thành công và ngược lại
     */
    function update($id, $ten, $ghiChu)
    {
        try {
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                UPDATE categorybyproducer
                SET tenproducer = ?,
                    ghichu = ?
                WHERE maproducer = ?
            ");
            $sql->bind_param("ssi", $ten, $ghiChu, $id);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Xóa 1 Producer
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
                FROM categorybyproducer
                WHERE maproducer = ?
            ");
            $sql->bind_param("i", $id);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Xóa tất cả Producer
     * True nếu xóa thành công và ngược lại
     */
    function deleteAll()
    {
        try {
            if (!self::$isConnectSuccess) return false;

            $all = $this->getAll();
            foreach($all as $item) {
                $this->delete($item['maproducer']);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Kiểm tra xem hãng hiện tại có product hay không
     */
    function checkHasProduct($id)
    {
        try {
            // Nếu kết nối thất bại
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                SELECT * 
                FROM products
                WHERE maproducer = ?
                LIMIT 1
            ");
            $sql->bind_param("i", $id);

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
