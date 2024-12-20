<?php 
require_once "../config/config.php";
require_once "../modals/dbModal.php";
session_start();

$dbModal = new DBModal();

if (!$dbModal->getConnectionStatus()) {
    require_once "./disconectLayout.php";
    die;
}

$imageComingSoon = 'product-coming-soon.jpg';