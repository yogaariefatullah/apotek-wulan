<?php
session_start();
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_sale'])) {
    $sale_id = $_POST['sale_id'];
    $medicine_id = $_POST['medicine_id'];
    $quantity = $_POST['quantity'];
    $total = $_POST['total'];

    if (updateSale($sale_id, $medicine_id, $quantity, $total)) {
        echo '<script>alert("Sale updated successfully");</script>';
        echo '<meta http-equiv="refresh" content="0; URL=\'sales.php\'" />';
        exit;
    } else {
        echo '<script>alert("Failed to update sale");</script>';
    }
}

// Ambil data sale berdasarkan ID
if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];
    $sale = getSaleById($sale_id); // Fungsi untuk mendapatkan data sale berdasarkan ID
    
$medicines = getMedicines();
} else {
    // Redirect atau tindakan lain jika ID tidak ada
    header("Location: sales.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Sale</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Edit Sale</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="medicines.php">Medicines</a>
        <a href="sales.php">Sales</a>
        <a href="logout.php">Logout</a>
    </nav>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="sale_id" value="<?php echo $sale_id; ?>">
        <label>Medicine:</label><br>
        <select name="medicine_id" required>
            <?php while ($row = $medicines->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $sale['medicine_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br>
        <label>Quantity:</label><br>
        <input type="number" name="quantity" value="<?php echo $sale['quantity']; ?>" required><br>
        <label>Total:</label><br>
        <input type="number" step="0.01" name="total" value="<?php echo $sale['total']; ?>" required><br>
        <button type="submit" name="update_sale">Update Sale</button>
    </form>
</body>
</html>
