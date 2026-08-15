<?php
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];

$stmt = $conn->prepare("INSERT INTO users (username, password, name) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $name);
$stmt->execute();

echo "저장 완료!";
?>