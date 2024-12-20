<?php 
require_once "./__checkConnect.php";

require_once "../config/config.php";
require_once "../modals/dbModal.php";
require_once "../modals/productModal.php";

$productModal = new ProductModal();

$productId = isset($_GET['idproduct']) ? $_GET['idproduct'] : null;
$productDetail = $productModal->getProductDetail($productId);
$productsRelated = $productModal->getProductsRelated($productDetail, 1, 4);
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
                <?php 
                if (!is_null($productDetail)) {
                ?>
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                            src="../admin/modules/quanlysanpham/images/<?= !empty($productDetail['hinh']) ? $productDetail['hinh'] : $imageComingSoon ?>" alt="..." />
                    </div>

                    <div class="col-md-6">
                        <div class="small mb-1">
                            <?php echo $productDetail['tendanhmuc'] ?>
                        </div>
                        <h1 class="display-5 fw-bolder">
                            <?php echo $productDetail['tensanpham'] ?>
                        </h1>
                        <div class="fs-5 mb-5">
                            <!-- <span class="text-decoration-line-through">$45.00</span> -->
                            <span>
                                <?php echo number_format($productDetail['gia'], 0, ',', '.') . ' VNĐ' ?>
                            </span>
                        </div>
                        <p class="lead">
                            <?php echo $productDetail['mota'] ?>
                        </p>
                        <form action="cart.php?idsanpham=<?php echo $productDetail['id_product'] ?>" method="get">
                            <input type="hidden" name="product_id" value="<?= $productDetail['id_product'] ?>">
                            <input type="hidden" name="action" value="add-cart">
                            <div class="d-flex">
                                <input class="form-control text-center me-3" type="number" value="1" name="qty"
                                    style="max-width: 3rem" />
                                <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    Thêm vào giỏ hàng
                                </button>
                            </div>
                        </form>
                    </div>

                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Sản phẩm liên quan</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($productsRelated as $sanPham) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="item.php?idproduct=<?php echo $sanPham['id_product'] ?>"><img
                                    class="card-img-top"
                                    src="../admin/modules/quanlysanpham/images/<?= !empty($sanPham['hinh']) ? $sanPham['hinh'] : $imageComingSoon ?>"
                                    alt="..." /></a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <a href="item.php?idproduct=<?php echo $sanPham['id_product'] ?>">
                                        <?php echo $sanPham['tensanpham'] ?>
                                    </a>
                                    <h6 class="fw-bolder"><a
                                            href="category.php?madanhmuc= <?php echo $sanPham['madanhmuc'] ?>">
                                            <?php echo $sanPham['tendanhmuc'] ?>
                                        </a></h6>
                                    <!-- Product price-->
                                    <?php echo number_format($sanPham['gia'], 0, ',', '.') . ' VNĐ' ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="cart.php?product_id=<?= $sanPham['id_product'] ?>&action=add-cart">Thêm Vào Giỏ
                                        Hàng</a>
                                </div>
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