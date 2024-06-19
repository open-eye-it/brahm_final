<?php
$base_url = "http://" . $_SERVER['SERVER_NAME'] . '/brahm_final/';
include('common/common.php');
session_destroy();
header('Location: ' . $base_url);
