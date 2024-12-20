<?php
// Check Login
session_start();
unset($_SESSION['admin_id']);
header("location:dangnhap/dangnhap.php");