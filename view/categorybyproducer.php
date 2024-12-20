<?php 
require_once "./__checkConnect.php";

require_once "../config/config.php";
require_once "../modals/dbModal.php";
require_once "../modals/productModal.php";

$productModal = new ProductModal();
$maproducer = isset($_GET["maproducer"]) ? $_GET["maproducer"] : null;
$danhSachSP = $productModal->getProductsByProducer($maproducer);
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
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                 <?php foreach ($danhSachSP as $sanPham) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="item.php?idproduct=<?php echo $sanPham['id_product'] ?>">
                            <img class="card-img-top"
                                src="../admin/modules/quanlysanpham/images/<?= !empty($sanPham['hinh']) ? $sanPham['hinh'] : $imageComingSoon ?>" alt="..." /></a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">
                                    <a href="item.php?idproduct=<?php echo $sanPham['id_product'] ?>">
                                        <?php echo $sanPham['tensanpham'] ?></a>
                                    </h5>
                                    <h6 class="fw-bolder">
                                        <a href="category.php?madanhmuc= <?php echo $sanPham['madanhmuc'] ?>"><?php echo $sanPham['tendanhmuc'] ?></a> 
                                    </h6>
                                    <h6 class="fw-bolder">
                                        <a href="categorybyproducer.php?maproducer= <?php echo $sanPham['maproducer'] ?>"><?php echo $sanPham['tenproducer'] ?></a> 
                                    </h6>
                                    <!-- Product -->
                                    <!-- Product price-->
                                    <?php echo number_format($sanPham['gia'], 0, ',', '.') . ' VNĐ' ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="cart.php?product_id=<?= $sanPham['id_product'] ?>&action=add-cart">Thêm Vào Giỏ
                                        Hàng</a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
</body>

</html>