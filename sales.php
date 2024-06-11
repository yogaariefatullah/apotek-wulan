<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/functions.php';

$sales = getSales();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Sales</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="medicines.php">Medicines</a>
        <a href="sales.php">Sales</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h3>Sales List</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Medicine</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>  
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $sales->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['medicine_id']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['sale_date']; ?></td>
                    <td>
                        <!-- Tombol untuk mengedit -->
                        <a href="edit_sale.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <!-- Tombol untuk menghapus -->
                        <a href="delete_sale.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
