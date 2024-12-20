<?php
require_once "../__checkUser.php";
require_once "../../../config/config.php";
require_once "../../../modals/dbModal.php";
require_once "../../../modals/categoryByProducerModal.php";

$producerModal = new CategoryByProducerModal();

$producerModal->deleteAll();
header('Location:crud.php');
?>