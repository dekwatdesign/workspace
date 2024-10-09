<?php
require '../configs/database.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT name, age, job FROM users";
$result = $conn->query($sql);

$users = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $users[] = $row;
  }
}

// ส่งข้อมูลกลับไปเป็น JSON
header('Content-Type: application/json');
echo json_encode($users);

$conn->close();
?>
