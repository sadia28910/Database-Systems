Admin Dashboard
<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "canteen_db";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $conn->query("INSERT INTO food_items (name, price) VALUES ('$name', $price)");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM food_items WHERE id=$id");
}

$items = $conn->query("SELECT * FROM food_items");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <h1>Admin Dashboard</h1>
    <h2>Add Item</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Food Name" required>
        <input type="number" name="price" placeholder="Price" required>
        <button type="submit" name="add">Add</button>
    </form>

    <h2>Items</h2>
    <table border="1" cellpadding="5">
        <tr><th>ID</th><th>Name</th><th>Price</th><th>Action</th></tr>
        <?php while($row=$items->fetch_assoc()){ ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['price'] ?></td>

            
            
            <td><a href="admin_dashboard.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

Backend:
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "canteen_db";

$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $food_id = $_POST['food_id'];
    $qty = $_POST['qty'];

    $result = $conn->query("SELECT name, price FROM food_items WHERE id=$food_id");
    $row = $result->fetch_assoc();
    $food_name = $row['name'];
    $price = $row['price'];
    $total_price = $price * $qty;

    $conn->query("INSERT INTO purchases (student_name, student_id, food_id, qty, total_price) 
                  VALUES ('$student_name', '$student_id', $food_id, $qty, $total_price)");

    echo "Hi <b>$student_name</b>! You ordered <b>$qty x $food_name</b>.<br>Total Amount: <b>$total_price BDT</b>";
}
?>

