<?php
session_start();

include('config/config.php');

$conn = OpenCon();
$index_url = '/brahm_final/index.php';

if (isset($_SESSION) && isset($_SESSION['token'])) {
    include('model/CheckLoginModel.php');
    $check = new CheckLoginModel($conn, $base_url, $index_url);
    $check->checkLogin($_SESSION['token']);
} else if ($_SERVER['REQUEST_URI'] != '/brahm_final/index.php') {
    header('Location: ' . $base_url . 'index.php');
} else {
}

$page_title = "East London & Essex Brahm Samaj";

include('model/LoginModel.php');

$loginModel = new LoginModel($conn);

include('model/UserModel.php');

$userModel = new UserModel($conn);

include('model/MembershipModel.php');

$membershipModel = new MembershipModel($conn);

include('model/ReceiptModel.php');

$receiptModel = new ReceiptModel($conn);

include('model/ReportModel.php');

$reportModel = new ReportModel($conn);

include('../export_function/export-excel.php');
include('../export_function/clsMSDocGenerator.php');
