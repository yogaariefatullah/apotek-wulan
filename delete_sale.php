<?php
session_start();
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];
    if (deleteSale($sale_id)) {
        echo '<script>alert("Sale deleted successfully");</script>';
    } else {
        echo '<script>alert("Failed to delete sale");</script>';
    }
}

header("Location: sales.php");
exit;
?>
