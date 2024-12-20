<?php
class ProductModal extends DBModal
{
    /**
     * Lấy tất cả sản phẩm
     * Nếu có truyền Page và Perpage lên thì mới phân trang sản phẩm
     * Nếu không truyền thì lấy hết sản phẩm
     * Nếu có bất kỳ lỗi nào xảy ra, trả về mảng rỗng
     */
    function getAll($page = null, $perPage = null, $keyword = null)
    {
        try {
            // Nếu kết nối thất bại, trả về mảng rỗng
            if (!self::$isConnectSuccess) return [];

            $queryKeyword = "";
            if (!is_null($keyword) && $keyword != "") $queryKeyword = "AND prod.tensanpham LIKE '%$keyword%'";

            $sqlGetAll = "
                SELECT * 
                FROM category cate, 
                    products prod, 
                    categorybyproducer cateByPro
                WHERE prod.madanhmuc = cate.madanhmuc 
                    AND prod.maproducer = cateByPro.maproducer
                    $queryKeyword
                ORDER BY prod.id_product DESC 
            ";

            // Nếu không truyền $page và $perPage, lấy toàn bộ dữ liệu
            if (is_null($page) || is_null($perPage)) {
                $sql = self::$connection->prepare($sqlGetAll);
            } else {
                // Tính toán offset dựa trên $page và $perPage
                $offset = ($page - 1) * $perPage;

                // Thực hiện query với LIMIT và OFFSET
                $sql = self::$connection->prepare($sqlGetAll . "LIMIT ? OFFSET ?");
                $sql->bind_param("ii", $perPage, $offset);
            }

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
     * Lấy danh sách sản phẩm theo Category
     * Nếu có truyền Page và Perpage lên thì mới phân trang sản phẩm
     * Nếu không truyền thì lấy hết sản phẩm
     * Nếu có bất kỳ lỗi nào xảy ra, trả về mảng rỗng
     */
    function getProducstByCategory($cate_id, $page = null, $perPage = null)
    {
        try {
            // Nếu kết nối thất bại, trả về mảng rỗng
            if (!self::$isConnectSuccess) return [];

            $sqlGetAll = "
                SELECT * 
                FROM category cate, 
                    products prod, 
                    categorybyproducer cateByPro
                WHERE prod.madanhmuc = cate.madanhmuc 
                    AND prod.maproducer = cateByPro.maproducer 
                    AND prod.madanhmuc = ?
                ORDER BY prod.id_product DESC 
            ";

            // Nếu không truyền $page và $perPage, lấy toàn bộ dữ liệu
            if (is_null($page) || is_null($perPage)) {
                $sql = self::$connection->prepare($sqlGetAll);
                $sql->bind_param("i", $cate_id);
            } else {
                // Tính toán offset dựa trên $page và $perPage
                $offset = ($page - 1) * $perPage;

                // Thực hiện query với LIMIT và OFFSET
                $sql = self::$connection->prepare($sqlGetAll . "LIMIT ? OFFSET ?");
                $sql->bind_param("iii", $cate_id, $perPage, $offset);
            }

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
     * Lấy danh sách sản phẩm theo producer
     * Nếu có truyền Page và Perpage lên thì mới phân trang sản phẩm
     * Nếu không truyền thì lấy hết sản phẩm
     * Nếu có bất kỳ lỗi nào xảy ra, trả về mảng rỗng
     */
    function getProductsByProducer($producer_id, $page = null, $perPage = null)
    {
        try {
            // Nếu kết nối thất bại, trả về mảng rỗng
            if (!self::$isConnectSuccess) return [];

            $sqlGetAll = "
                SELECT * 
                FROM category cate, 
                    products prod, 
                    categorybyproducer cateByPro
                WHERE prod.madanhmuc = cate.madanhmuc 
                    AND prod.maproducer = cateByPro.maproducer 
                    AND prod.maproducer = ?
                ORDER BY prod.id_product DESC 
            ";

            // Nếu không truyền $page và $perPage, lấy toàn bộ dữ liệu
            if (is_null($page) || is_null($perPage)) {
                $sql = self::$connection->prepare($sqlGetAll);
                $sql->bind_param("i", $producer_id);
            } else {
                // Tính toán offset dựa trên $page và $perPage
                $offset = ($page - 1) * $perPage;

                // Thực hiện query với LIMIT và OFFSET
                $sql = self::$connection->prepare($sqlGetAll . "LIMIT ? OFFSET ?");
                $sql->bind_param("iii", $producer_id, $perPage, $offset);
            }

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
     * Lấy chi tiết 1 sản phẩm theo mã
     * Nếu không tìm thấy hoặc có bất kỳ lỗi nào, trả về null
     */
    function getProductDetail($product_id)
    {
        try {
            // Nếu kết nối thất bại
            if (!self::$isConnectSuccess) return null;

            $sql = self::$connection->prepare("
                SELECT * 
                FROM category cate, 
                    products prod, 
                    categorybyproducer cateByPro
                WHERE prod.madanhmuc = cate.madanhmuc 
                    AND prod.maproducer = cateByPro.maproducer 
                    AND prod.id_product = ?
                LIMIT 1
            ");
            $sql->bind_param("i", $product_id);

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
     * Lấy danh sách sản phẩm liên quan 1 sản phẩm
     * Nếu có truyền Page và Perpage lên thì mới phân trang sản phẩm
     * Nếu không truyền thì lấy hết sản phẩm
     * Nếu có bất kỳ lỗi nào xảy ra, trả về mảng rỗng
     */
    function getProductsRelated($mainProduct, $page = null, $perPage = null)
    {
        try {
            // Nếu kết nối thất bại, trả về mảng rỗng
            if (!self::$isConnectSuccess || is_null($mainProduct)) return [];
            $mainProductId = $mainProduct['id_product'];
            $maDanhMuc = $mainProduct['madanhmuc'];
            $maProducer = $mainProduct['maproducer'];

            $sqlGetAll = "
                SELECT * 
                FROM category cate, 
                    products prod, 
                    categorybyproducer cateByPro
                WHERE prod.madanhmuc = cate.madanhmuc 
                    AND prod.maproducer = cateByPro.maproducer 
                    AND prod.id_product != ?
                    AND prod.madanhmuc = ?
                    AND prod.maproducer = ?
                ORDER BY prod.id_product DESC 
            ";

            // Nếu không truyền $page và $perPage, lấy toàn bộ dữ liệu
            if (is_null($page) || is_null($perPage)) {
                $sql = self::$connection->prepare($sqlGetAll);
                $sql->bind_param("iii", $mainProductId, $maDanhMuc, $maProducer);
            } else {
                // Tính toán offset dựa trên $page và $perPage
                $offset = ($page - 1) * $perPage;

                // Thực hiện query với LIMIT và OFFSET
                $sql = self::$connection->prepare($sqlGetAll . "LIMIT ? OFFSET ?");
                $sql->bind_param("iiiii", $mainProductId, $maDanhMuc, $maProducer, $perPage, $offset);
            }

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
     * Thêm 1 product
     * True nếu thêm thành công và ngược lại
     */
    function add($masanpham, $tensanpham, $gia, $mota, $hinh, $madanhmuc, $maproducer)
    {
        var_dump($gia);
        try {
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                INSERT INTO products(`masanpham`, `tensanpham`, `gia`, `mota`, `hinh`, `madanhmuc`, `maproducer`)
                VALUE (?, ?, ?, ?, ?, ?, ?)
            ");
            $sql->bind_param("ssissii", $masanpham, $tensanpham, $gia, $mota, $hinh, $madanhmuc, $maproducer);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Cập nhật 1 Product
     * True nếu cập nhật thành công và ngược lại
     */
    function update($id_product , $masanpham, $tensanpham, $gia, $mota, $hinh, $madanhmuc, $maproducer, $isUpdateImage)
    {
        try {
            if (!self::$isConnectSuccess) return false;
            if ($isUpdateImage) {
                $sql = self::$connection->prepare("
                UPDATE products
                SET masanpham = ?,
                    tensanpham = ?,
                    gia = ?,
                    mota = ?,
                    hinh = ?,
                    madanhmuc = ?,
                    maproducer = ?
                WHERE id_product = ?
            ");
                $sql->bind_param("ssissiii", $masanpham, $tensanpham, $gia, $mota, $hinh, $madanhmuc, $maproducer, $id_product);
            } else {
                $sql = self::$connection->prepare("
                UPDATE products
                SET masanpham = ?,
                    tensanpham = ?,
                    gia = ?,
                    mota = ?,
                    madanhmuc = ?,
                    maproducer = ?
                WHERE id_product = ?
            ");
                $sql->bind_param("ssisiii", $masanpham, $tensanpham, $gia, $mota, $madanhmuc, $maproducer, $id_product);
            }
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Xóa 1 Product
     * True nếu cập nhật thành công và ngược lại
     */
    function delete($id_product)
    {
        try {
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                DELETE 
                FROM products
                WHERE id_product = ?
            ");
            $sql->bind_param("i", $id_product);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Xóa tất cả product
     * True nếu cập nhật thành công và ngược lại
     */
    function deleteAll()
    {
        try {
            if (!self::$isConnectSuccess) return false;

            $sql = self::$connection->prepare("
                DELETE 
                FROM products
            ");
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Lấy số lượng tất cả sản phẩm
     * Nếu có bất kỳ lỗi nào xảy ra, trả về số 0
     */
    function getCountAllProduct($keyword = null)
    {
        try {
            // Nếu kết nối thất bại
            if (!self::$isConnectSuccess) return 0;

            $queryKeyword = "";
            if (!is_null($keyword) && $keyword != "") $queryKeyword = "WHERE tensanpham LIKE '%$keyword%'";

            $sql = self::$connection->prepare("
                SELECT COUNT(*) AS TotalProducts
                FROM products
                $queryKeyword
            ");
            // Thực thi câu lệnh
            $sql->execute();

            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($items) > 0) return (int) $items[0]['TotalProducts'];
            return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Lấy tất cả sản phẩm theo các id cụ thể
     */
    function getAllByIds($listId)
    {
        try {
            // Nếu kết nối thất bại, trả về mảng rỗng
            if (!self::$isConnectSuccess || count($listId) === 0) return [];

            $listIdString = implode(", ", $listId);

            $sqlGetAll = "
                SELECT * 
                FROM category cate, 
                    products prod, 
                    categorybyproducer cateByPro
                WHERE prod.madanhmuc = cate.madanhmuc 
                    AND prod.maproducer = cateByPro.maproducer
                    AND prod.id_product IN ($listIdString)
            ";

            $sql = self::$connection->prepare($sqlGetAll);

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
}
