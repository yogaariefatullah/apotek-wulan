<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        deleteMedicine($id);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        updateMedicine($id, $name, $price, $stock);
    }
}

$medicines = getMedicines();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medicines</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <h2>Medicines</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="medicines.php">Medicines</a>
        <a href="sales.php">Sales</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h3>Medicine List</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $medicines->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td>
                        <form method="post" action="" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                        <button class="update-button" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>" data-stock="<?php echo $row['stock']; ?>">Update</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div id="update-form" style="display:none;">
        <h3>Update Medicine</h3>
        <form method="post" action="">
            <input type="hidden" name="id" id="update-id">
            <label>Name:</label><br>
            <input type="text" name="name" id="update-name" required><br>
            <label>Price:</label><br>
            <input type="number" step="0.01" name="price" id="update-price" required><br>
            <label>Stock:</label><br>
            <input type="number" name="stock" id="update-stock" required><br>
            <button type="submit" name="update">Update Medicine</button>
        </form>
    </div>
</body>
</html>
