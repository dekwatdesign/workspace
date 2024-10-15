<?php
$host = 'localhost';  // เปลี่ยนเป็น host ของคุณ
$dbname = 'workspace';  // ชื่อฐานข้อมูล
$user = 'root';  // ชื่อผู้ใช้ฐานข้อมูล
$pass = '';  // รหัสผ่านฐานข้อมูล

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลทั้งหมดจากตาราง tasks
    $stmt = $pdo->prepare("SELECT * FROM tasks");
    $stmt->execute();

    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tasks);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
