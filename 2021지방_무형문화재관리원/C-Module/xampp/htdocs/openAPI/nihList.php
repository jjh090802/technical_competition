<?php

$pdo = new PDO('mysql:host=localhost;dbname=nihc;charset=utf8mb4', 'root', '');

header('Content-Type: application/json; charset=utf-8');

$pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 0;
$numOfRows = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 0;
$bcodeName = isset($_GET['bcodeName']) ? $_GET['bcodeName'] : '';

if ($pageNo < 1 || $numOfRows < 1 || $numOfRows > 100) {
    http_response_code(400);
    echo json_encode(array('error' => 'pageNo(1 이상)와 numOfRows(1~100)를 숫자로 꼭 보내야 합니다.'), JSON_UNESCAPED_UNICODE);
    exit;
}

$where = "";
$params = array();
if ($bcodeName != '') {
    $where = "WHERE bcodeName LIKE ?";
    $params[] = '%' . $bcodeName . '%';
}

$stmt = $pdo->prepare("SELECT COUNT(*) FROM nih $where");
$stmt->execute($params);
$totalCount = (int)$stmt->fetchColumn();

$start = ($pageNo - 1) * $numOfRows;
$stmt = $pdo->prepare("SELECT * FROM nih $where ORDER BY id LIMIT $start, $numOfRows");
$stmt->execute($params);

$fields = array('ccbaKdcd', 'ccbaAsno', 'ccbaCtcd', 'ccbaCpno', 'longitude', 'latitude', 'ccmaName', 'crltsnoNm',
    'ccbaMnm1', 'ccbaMnm2', 'gcodeName', 'bcodeName', 'mcodeName', 'scodeName', 'ccbaQuan', 'ccbaAsdt',
    'ccbaCtcdNm', 'ccsiName', 'ccbaLcad', 'ccceName', 'ccbaPoss', 'ccbaAdmin', 'ccbaCncl', 'ccbaCndt', 'image', 'content');

$items = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $item = array();
    foreach ($fields as $f) {
        if ($row[$f] == null) {
            $item[$f] = '';
        } else {
            $item[$f] = $row[$f];
        }
    }

    $item['image'] = '';
    $path = 'C:/xampp/nihcImage/' . $row['image'];
    if ($row['image'] != '' && file_exists($path)) {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if ($ext == 'jpg') {
            $ext = 'jpeg';
        }
        $item['image'] = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($path));
    }

    $items[] = $item;
}

$data = array(
    'numOfRows' => $numOfRows,
    'pageNo' => $pageNo,
    'totalCount' => $totalCount,
    'items' => $items,
);

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
