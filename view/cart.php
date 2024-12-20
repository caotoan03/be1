<?php
require_once "./__checkConnect.php";

require_once "../config/config.php";
require_once "../modals/dbModal.php";
require_once "../modals/productModal.php";

$productModal = new ProductModal();

function showScriptVaLoadLaiTrang($message, $isShowAlert = true)
{
    $script = '<script>';
    if ($isShowAlert) $script.= 'alert("' . $message . '")';
    $script .= '
        window.location.href = "cart.php";
    </script>';
    echo $script;
}

// Xử lý xóa item
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === "add-cart" && isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $qty = isset($_GET['qty']) ? $_GET['qty'] : 1;
        if ($qty <= 0) $qty = 1;

        if (isset($_SESSION['cart'][$product_id])) $_SESSION['cart'][$product_id]+= $qty;
        else $_SESSION['cart'][$product_id] = $qty;
        showScriptVaLoadLaiTrang("Đã thêm vào giỏ hàng");
    } else if ($action === "delete-item" && isset($_GET['item-id'])) {
        $itemId = $_GET['item-id'];
        unset($_SESSION['cart'][$itemId]);
        showScriptVaLoadLaiTrang("Xóa sản phẩm ra khỏi giỏ hàng thành công");
    } else if ($action === "delete-all") {
        unset($_SESSION['cart']);
        showScriptVaLoadLaiTrang("Xóa tất cả sản phẩm ra khỏi giỏ hàng thành công");
    } else if ($action === "change-qty" && isset($_GET['id']) && isset($_GET['qty'])) {
        $qty = $_GET['qty'] > 0 ? $_GET['qty'] : 1;
        $id = $_GET['id'];
        $_SESSION['cart'][$id] = $qty;
        showScriptVaLoadLaiTrang('', false);
    }
}

// Lý lý lấy thông tin sản phẩm trong cart
$arrayCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$listId = array_keys($arrayCart);

$listProduct = $productModal->getAllByIds($listId);
$listProductInCart = [];

foreach ($arrayCart as $id => $qty) {
    foreach ($listProduct as $product) {
        if ($product['id_product'] === $id) {
            $listProductInCart[] = array_merge(
                $product,
                [
                    'qty' => $qty,
                    'tongGia' => $qty * $product['gia'],
                ]
            );
            break;
        }
    }
}

$thongTinTong = array_reduce($listProductInCart, function ($carry, $item) {
    $carry['tongSoLuong'] += $item['qty'];
    $carry['tongGia'] += $item['tongGia'];
    return $carry;
}, [
    'tongSoLuong' => 0,
    'tongGia' => 0,
]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Item - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation -->
    <?php
    require_once "./_navbarNavigation.php";
    ?>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div id="shopping-cart">
                    <h2>Shopping Cart</h2>
                    <div class="float-end">
                        <a class="btn btn-outline-dark mt-auto btn-delete" href="#" data-action="delete-all">Xóa toàn bộ</a>
                    </div>
                    <?php if (count($listProductInCart) === 0) { ?>
                        <p>Chưa có sản phẩm nào trong giỏ hàng !</p>
                    <?php } else { ?>
                        <table class="table" cellpadding="10" cellspacing="1">
                            <tbody>
                                <tr>
                                    <th style="text-align:left;">Tên sản phẩm</th>
                                    <th style="text-align:left;">Tên danh mục</th>
                                    <th style="text-align:right;" width="10%">Số lượng</th>
                                    <th style="text-align:right;" width="10%">Giá<br>(VNĐ)</th>
                                    <th style="text-align:right;" width="10%">Tổng cộng<br>(VNĐ)</th>
                                    <th style="text-align:center;" width="5%">Xóa</th>
                                </tr>
                                <?php foreach ($listProductInCart as $product) { ?>
                                    <tr>
                                        <td><?= $product["tensanpham"] ?></td>
                                        <td><?= $product["tendanhmuc"] ?></td>
                                        <td style="text-align:right;">
                                            <input 
                                                class="input-qty"
                                                type="number"
                                                value="<?= $product["qty"] ?>"
                                                style="width: 100%; text-align: center;"
                                                data-id="<?= $product["id_product"] ?>"
                                            >
                                        </td>
                                        <td style="text-align:right;"><?= number_format($product["gia"]) ?></td>
                                        <td style="text-align:right;"><?= number_format($product["tongGia"]) ?></td>
                                        <td style="text-align:center;">
                                            <a href="#"
                                                class="btn-delete"
                                                data-action="delete-item"
                                                data-name="<?= $product["tensanpham"] ?>"
                                                data-id="<?= $product["id_product"] ?>">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" align="right">Total:</td>
                                    <td align="right"><?= $thongTinTong["tongSoLuong"] ?></td>
                                    <td align="right" colspan="2"><strong><?= number_format($thongTinTong["tongGia"]) ?></strong></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script>
        // Lấy tất cả các phần tử có class "btn-delete"
        const deleteButtons = document.querySelectorAll('.btn-delete');

        // Thêm sự kiện click cho mỗi phần tử
        deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                // Hủy hành vi mặc định của trình duyệt
                event.preventDefault();
                const action = button.getAttribute('data-action');

                if (action === "delete-item") {
                    // Lấy các giá trị data từ phần tử
                    const name = button.getAttribute('data-name');
                    const id = button.getAttribute('data-id');

                    if (confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${name}" ra khỏi giỏ hàng không?`)) {
                        window.location.href = `cart.php?action=${action}&item-id=${id}`;
                    }
                } else if (action === "delete-all") {
                    if (confirm(`Bạn có chắc chắn muốn tất cả sản phẩm ra khỏi giỏ hàng không?`)) {
                        window.location.href = `cart.php?action=${action}`;
                    }
                }
            });
        });


        // Thêm sự kiện mỗi lần thay đổi qty
        const inputQtys = document.querySelectorAll('.input-qty');
        inputQtys.forEach(input => {
            input.addEventListener('blur', (event) => {
                // Hủy hành vi mặc định của trình duyệt
                event.preventDefault();
                const id = input.getAttribute('data-id');
                const value = event.target.value;
                const action = "change-qty";
                window.location.href = `cart.php?action=${action}&qty=${value}&id=${id}`;
            });
        });
    </script>
</body>

</html>