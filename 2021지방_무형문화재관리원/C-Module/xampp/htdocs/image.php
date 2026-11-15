<?php
$file = isset($_GET['file']) ? basename($_GET['file']) : '';
$path = 'C:/xampp/nihcImage/' . $file;

if ($file == '' || !file_exists($path)) {
    http_response_code(404);
    exit;
}

$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
if ($ext == 'png') {
    header('Content-Type: image/png');
} else if ($ext == 'gif') {
    header('Content-Type: image/gif');
} else {
    header('Content-Type: image/jpeg');
}

readfile($path);
