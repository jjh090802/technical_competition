<?php

$pdo = new PDO('mysql:host=localhost;dbname=nihc;charset=utf8mb4', 'root', '');

header('Content-Type: application/json; charset=utf-8');

$searchType = isset($_GET['searchType']) ? $_GET['searchType'] : '';
$year = isset($_GET['year']) ? (int)$_GET['year'] : 0;
$month = isset($_GET['month']) ? (int)$_GET['month'] : 0;

$error = '';
if ($searchType != 'M' && $searchType != 'Y') {
    $error = 'searchType 은 M(월별) 또는 Y(년도별)로 꼭 보내야 합니다.';
} else if ($year < 1000 || $year > 9999) {
    $error = 'year 는 4자리 년도로 꼭 보내야 합니다.';
} else if ($searchType == 'M' && ($month < 1 || $month > 12)) {
    $error = '월별 조회(M)에는 month(1~12)를 꼭 보내야 합니다.';
}

if ($error != '') {
    http_response_code(400);
    echo json_encode(array('error' => $error), JSON_UNESCAPED_UNICODE);
    exit;
}

if ($searchType == 'M') {
    $stmt = $pdo->prepare("SELECT * FROM show_info WHERE YEAR(showDate) = ? AND MONTH(showDate) = ? ORDER BY showDate, showTime");
    $stmt->execute(array($year, $month));
} else {
    $month = null;
    $stmt = $pdo->prepare("SELECT * FROM show_info WHERE YEAR(showDate) = ? ORDER BY showDate, showTime");
    $stmt->execute(array($year));
}

$items = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $item = array();
    $item['showUid'] = (int)$row['showUid'];
    $item['showName'] = $row['showName'];
    $item['showDt'] = $row['showDate'] . ' ' . substr($row['showTime'], 0, 5);
    $item['organizer'] = $row['organizer'] == null ? '' : $row['organizer'];
    $item['place'] = $row['place'] == null ? '' : $row['place'];
    $item['cast'] = $row['cast'] == null ? '' : $row['cast'];
    $item['rm'] = $row['rm'] == null ? '' : $row['rm'];
    $items[] = $item;
}

$data = array(
    'showType' => $searchType,
    'year' => $year,
    'month' => $month,
    'totalCount' => count($items),
    'items' => $items,
);

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
