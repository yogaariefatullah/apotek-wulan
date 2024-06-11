<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/functions.php';

// Proses tambah obat
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_medicine'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    if (addMedicine($name, $price, $stock)) {
        echo '<script>alert("Medicine added successfully");</script>';
        echo '<meta http-equiv="refresh" content="0; URL=\'dashboard.php\'" />';
        exit;
    } else {
        echo '<script>alert("Failed to add medicine");</script>';
    }
}

// Proses jual obat
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sell_medicine'])) {
    $medicine_id = $_POST['medicine_id'];
    $quantity = $_POST['quantity'];

    if (sellMedicine($medicine_id, $quantity)) {
        echo '<script>alert("Medicine sold successfully");</script>';
        echo '<meta http-equiv="refresh" content="0; URL=\'dashboard.php\'" />';
        exit;
    } else {
        echo '<script>alert("Periksa kembali data yang di masukan");</script>';
    }
}

$medicines = getMedicines();
$currentDate = date('Y-m-d');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Dashboard</h2>
    <p>Today's Date: <?php echo $currentDate; ?></p>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="medicines.php">Medicines</a>
        <a href="sales.php">Sales</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h3>Add Medicine</h3>
    <form id="add-medicine-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" required><br>
        <label>Stock:</label><br>
        <input type="number" name="stock" required><br>
        <button type="submit" name="add_medicine">Add Medicine</button>
    </form>

    <h3>Sell Medicine</h3>
    <form id="sell-medicine-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Medicine:</label><br>
        <select name="medicine_id" required>
            <?php while ($row = $medicines->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br>
        <label>Quantity:</label><br>
        <input type="number" name="quantity" required><br>
        <button type="submit" name="sell_medicine">Sell Medicine</button>
    </form>
</body>
</html>
