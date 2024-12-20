<?php 
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/categoryModal.php";

$categoryModal = new CategoryModal();
$categories = $categoryModal->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Quản Lý Danh Mục</title>
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
								<h2>Quản Lý Danh Mục</h2>
							</div>
							<div class="col-sm-6">
								<a href="add.php" class="btn btn-success" data-toggle="modal"><i
										class="bi bi-pencil"></i><span>Add New Category</span></a>
								<a href="#" 
									class="btn btn-danger" 
									data-toggle="modal"
									data-action="delete-all"
								>
									<i class="bi bi-trash"></i> 
									<span>Delete All</span>
								</a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tên Danh Mục</th>
								<th>Ghi Chú</th>
							</tr>
						</thead>
						<?php foreach ($categories as $key=>$cate) { ?>
							<tr>
								<td><?php echo ($key + 1) ?></td>
								<td><?php echo $cate['tendanhmuc'] ?></td>
								<td><?php echo $cate['ghichu'] ?></td>
								<td>
									<a href="update.php?madanhmuc=<?php echo $cate['madanhmuc'] ?>" 
										class="edit" 
										data-toggle="modal">
											<i class="bi bi-pencil"></i>
									</a>
									<a href="#" 
										data-action="delete-item"
										data-id="<?= $cate['madanhmuc'] ?>"
										data-name="<?= $cate['tendanhmuc'] ?>"
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
                    if (confirm(`Bạn có chắc chắn muốn xóa danh mục "${name}"?\nLưu ý rằng nếu còn sản phẩm thuộc danh mục này thì không thể xóa!`)) {
                        window.location.href = `xuly.php?madanhmuc=${id}`;
                    }
                } else if (action === "delete-all") {
                    if (confirm(`Bạn có chắc chắn muốn xóa tất cả danh mục?\nLưu ý những danh mục còn sản phẩm thì không thể xóa!`)) {
                        window.location.href = `deleteall.php`;
                    }
                }
            });
        });
    </script>

</body>

</html>