<?php 
require_once "./__checkConnect.php";

require_once "../config/config.php";
require_once "../modals/dbModal.php";
require_once "../modals/productModal.php";

$productModal = new ProductModal();

// Keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;

// Pagination
$itemPerPage = 4;
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$totalProduct = $productModal->getCountAllProduct($keyword);
$totalPage = ceil($totalProduct / $itemPerPage);

$danhSachSanPham = $productModal->getAll($currentPage, $itemPerPage, $keyword);

$url = $_SERVER['PHP_SELF'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
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
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">PPT SHOPSHOP</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="form-tim-kiem">
                <form action="<?= $url ?>" method="get">
                    <label for="keyword">Tìm kiếm sản phẩm:</label>
                    <input type="search" name="keyword" placeholder="Nhập tên sản phẩm tìm kiếm ...">
                    <input type="hidden" name="page" value="1"/>
                    <input type="submit" value="Tìm kiếm">
                </form>
            </div>

            <?php if ($totalPage > 0) { ?>
                <p><?php echo "Trang $currentPage/$totalPage" ?></p>
            <?php } ?>

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($danhSachSanPham as $sanPham) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="item.php?idproduct=<?php echo $sanPham['id_product'] ?>"><img class="card-img-top"
                                    src="../admin/modules/quanlysanpham/images/<?= !empty($sanPham['hinh']) ? $sanPham['hinh'] : $imageComingSoon ?>" alt="..." /></a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">
                                        <a href="item.php?idproduct=<?php echo $sanPham['id_product'] ?>"><?php echo $sanPham['tensanpham'] ?></a>
                                    </h5>
                                    <h6 class="fw-bolder">
                                        <a href="category.php?madanhmuc= <?php echo $sanPham['madanhmuc'] ?>"><?php echo $sanPham['tendanhmuc'] ?></a>
                                    </h6>
                                    <h6 class="fw-bolder">
                                        <a href="categorybyproducer.php?maproducer= <?php echo $sanPham['maproducer'] ?>"><?php echo $sanPham['tenproducer'] ?></a>
                                    </h6>
                                    <!-- Product price-->
                                    <?php echo number_format($sanPham['gia'], 0, ',', '.') . ' VNĐ' ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="cart.php?product_id=<?= $sanPham['id_product'] ?>&action=add-cart">Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="list-page-pagination">
                    <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                        <a class="page-pagination <?php if ($i == $currentPage) echo "active" ?>" 
                            href="<?php 
                            echo $url . '?page=' . $i . (!is_null($keyword) ? ("&keyword=" . $keyword) : "")
                            ?>"
                        ><?php echo $i ?></a>
                    <?php } ?>
                </div>
            </div>

        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2024~</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>