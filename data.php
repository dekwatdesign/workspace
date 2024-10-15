<?php
require './configs/database.php';



if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// สร้าง SQL Query เพื่อนำข้อมูลจากตาราง users
$sql = "SELECT id, name, gender, birthdate, salary FROM users";
$result = $conn->query($sql);

// สร้าง Array สำหรับเก็บข้อมูล
$data = array();

if ($result->num_rows > 0) {
  // ดึงข้อมูลจากผลลัพธ์และเก็บไว้ใน array
  while($row = $result->fetch_assoc()) {
      $data[] = $row;
  }
}

header('Content-Type: application/json; charset=utf-8');
// แปลงข้อมูลเป็น JSON และส่งกลับไปที่ client
echo json_encode($data);

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();