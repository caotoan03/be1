<?php 
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/productModal.php";

$productModal = new ProductModal();
$products = $productModal->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Quản Lý Sản Phẩm</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<!-- Bootstrap icons-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="../css/styles.css" rel="stylesheet" />
</head>

<body>
	<!-- Product section-->
	<section class="py-5">
		<div class="container px-4 px-lg-5 my-5">
			<div class="row gx-4 gx-lg-5 align-items-center">
				<div class="table-wrapper">
					<div class="table-title">
						<a href="../../index.php">&#8592; Menu</a>
						<div class="row">
							<div class="col-sm-6">
								<h2>Quản Lý Sản Phẩm</h2>
							</div>
							<div class="col-sm-6">
								<a href="add.php" class="btn btn-success" data-toggle="modal"><i
										class="bi bi-pencil"></i><span>Add New Products</span></a>
								<a href="#" 
									class="btn btn-danger" 
									data-toggle="modal"
									data-action="delete-all"
								>
									<i class="bi bi-trash"></i> <span>Delete All</span>
								</a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Mã Sản Phẩm </th>
								<th>Tên Sản Phẩm</th>
								<th>Giá</th>
								<th>Mô tả</th>
								<th>Danh mục</th>
								<th>Hãng</th>
								<th>Ảnh</th>
							</tr>
						</thead>
						<?php foreach ($products as $key=>$item) { ?>
							<tr>
								<td><?php echo ($key + 1) ?></td>
								<td><?php echo $item['masanpham'] ?></td>
								<td><?php echo $item['tensanpham'] ?></td>
								<td><?php echo $item['gia'] ?></td>
								<td><?php echo $item['mota'] ?></td>
								<td><?php echo $item['tendanhmuc'] ?></td>
								<td><?php echo $item['tenproducer'] ?></td>
								<td>
									<img src="images/<?= !empty($item['hinh']) ? $item['hinh'] : $imageComingSoon ?>" style='width:100px'>
								</td>
								<td>
									<a href="update.php?idproduct=<?php echo $item['id_product'] ?>" 
										class="edit" 
										data-toggle="modal">
											<i class="bi bi-pencil"></i>
									</a>
									<a href="#" 
										data-action="delete-item"
										data-id="<?= $item['id_product'] ?>"
										data-name="<?= $item['tensanpham'] ?>"
										class="delete" 
										data-toggle="modal">
										<i class='bi bi-trash'></i>
									</a>
								</td>
							</tr>
						<?php } ?>	
				</div>
			</div>
	</section>

	<!-- Bootstrap core JS-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Core theme JS-->
	<script src="js/scripts.js"></script>
	<script>
        const deleteButtons = document.querySelectorAll('[data-action]');

        deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                const action = button.getAttribute('data-action');

                if (action === "delete-item") {
                    const name = button.getAttribute('data-name');
                    const id = button.getAttribute('data-id');
                    if (confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${name}"?\nLưu ý rằng sau khi xóa không thể hoàn tác!`)) {
                        window.location.href = `xuly.php?idproduct=${id}`;
                    }
                } else if (action === "delete-all") {
                    if (confirm(`Bạn có chắc chắn muốn xóa tất cả sản phẩm?\nLưu ý rằng sau khi xóa không thể hoàn tác!`)) {
                        window.location.href = `deleteall.php`;
                    }
                }
            });
        });
    </script>

</body>

</html>