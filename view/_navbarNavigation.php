<?php
require_once "../config/config.php";
require_once "../modals/dbModal.php";
require_once "../modals/categoryModal.php";
require_once "../modals/categoryByProducerModal.php";

$categoryModal = new CategoryModal();
$categoryByProducerModal = new CategoryByProducerModal();

$danhSachDanhMuc = $categoryModal->getAll();
$danhSachHang = $categoryByProducerModal->getAll();

$arrayCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$qtys = array_values($arrayCart);

$totalCart = array_reduce($qtys, function ($carry, $item) {
    return $carry += $item;
}, 0);

?>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#!">Liên Hệ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Sản Phẩm</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($danhSachDanhMuc as $danhMuc) { ?>
                            <li>
                                <a class="dropdown-item"
                                    href="category.php?madanhmuc=<?php echo $danhMuc['madanhmuc'] ?>">
                                    <?php echo $danhMuc['tendanhmuc'] ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Hãng</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($danhSachHang as $hang) { ?>
                            <li>
                                <a class="dropdown-item"
                                    href="categorybyproducer.php?maproducer=<?php echo $hang['maproducer'] ?>">
                                    <?php echo $hang['tenproducer'] ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" action="cart.php">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $totalCart ?></span>
                </button>
            </form>
        </div>
    </div>
</nav>