<?php
include 'db.php';

function register($username, $password) {
    global $conn;
    $password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    return $conn->query($sql);
}

function login($username, $password) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}

function addMedicine($name, $price, $stock) {
    global $conn;
    $sql = "INSERT INTO medicines (name, price, stock) VALUES ('$name', '$price', '$stock')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function getMedicines() {
    global $conn;
    $sql = "SELECT * FROM medicines";
    return $conn->query($sql);
}

function updateMedicine($id, $name, $price, $stock) {
    global $conn;
    $sql = "UPDATE medicines SET name='$name', price='$price', stock='$stock' WHERE id='$id'";
    return $conn->query($sql);
}

function deleteMedicine($id) {
    global $conn;
    $sql = "DELETE FROM medicines WHERE id='$id'";
    return $conn->query($sql);
}


function sellMedicine($medicine_id, $quantity) {
    global $conn;
    // Ambil informasi obat dari database
    $sql = "SELECT * FROM medicines WHERE id='$medicine_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $medicine = $result->fetch_assoc();
        $current_stock = $medicine['stock'];

        // Hitung total harga berdasarkan harga obat dan jumlah yang dijual
        $total = $medicine['price'] * $quantity;

        // Pastikan stok mencukupi sebelum menjual
        if ($current_stock >= $quantity) {
            // Kurangi stok obat
            $new_stock = $current_stock - $quantity;
            $conn->query("UPDATE medicines SET stock='$new_stock' WHERE id='$medicine_id'");
            
            // Catat penjualan ke dalam tabel sales
            $conn->query("INSERT INTO sales (medicine_id, quantity, total) VALUES ('$medicine_id', '$quantity', '$total')");
            
            return true; // Penjualan berhasil
        } else {
            return false; // Stok tidak mencukupi
        }
    } else {
        return false; // Obat tidak ditemukan
    }
}

// Update sales record
function updateSale($sale_id, $medicine_id, $quantity, $total) {
    global $conn;
    $sql = "UPDATE sales SET medicine_id='$medicine_id', quantity='$quantity', total='$total' WHERE id='$sale_id'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Delete sales record
function deleteSale($sale_id) {
    global $conn;
    $sql = "DELETE FROM sales WHERE id='$sale_id'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}



// Mendapatkan data penjualan
function getSales() {
    global $conn;
    $sql = "SELECT * FROM sales";
    $result = $conn->query($sql);
    return $result;
}
// Mendapatkan data penjualan berdasarkan ID
function getSaleById($sale_id) {
    global $conn;
    $sql = "SELECT * FROM sales WHERE id='$sale_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

?>
