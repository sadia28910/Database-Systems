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

