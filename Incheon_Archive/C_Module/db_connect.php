<?php
$conn = new mysqli("localhost", "root", "", "incheon_archive");

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}
?>