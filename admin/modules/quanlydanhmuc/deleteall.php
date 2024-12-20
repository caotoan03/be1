<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/categoryModal.php";

$categoryModal = new CategoryModal();

$categoryModal->deleteAll();
header('Location:crud.php');
?>