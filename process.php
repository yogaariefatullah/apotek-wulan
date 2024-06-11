<?php
session_start();
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses form tambah obat
    if (isset($_POST['add_medicine'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        if (addMedicine($name, $price, $stock)) {
            echo json_encode(['success' => true, 'message' => 'Medicine added successfully']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Periksa kembali data yang di masukan']);
            exit;
        }
    }

    // Proses form jual obat
    if (isset($_POST['sell_medicine'])) {
        $medicine_id = $_POST['medicine_id'];
        $quantity = $_POST['quantity'];

        if (sellMedicine($medicine_id, $quantity)) {
            echo json_encode(['success' => true, 'message' => 'Medicine sold successfully']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Periksa kembali data yang di masukan']);
            exit;
        }
    }
}

// Jika permintaan tidak sesuai atau tidak valid
echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit;
?>
