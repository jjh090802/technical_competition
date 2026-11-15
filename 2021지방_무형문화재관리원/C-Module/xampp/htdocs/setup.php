<?php

$pdo = new PDO('mysql:host=localhost;dbname=nihc;charset=utf8mb4', 'root', '');

$fields = array('sn', 'no', 'ccbaKdcd', 'ccbaAsno', 'ccbaCtcd', 'ccbaCpno', 'longitude', 'latitude',
    'ccmaName', 'crltsnoNm', 'ccbaMnm1', 'ccbaMnm2', 'gcodeName', 'bcodeName', 'mcodeName', 'scodeName',
    'ccbaQuan', 'ccbaAsdt', 'ccbaCtcdNm', 'ccsiName', 'ccbaLcad', 'ccceName', 'ccbaPoss', 'ccbaAdmin',
    'ccbaCncl', 'ccbaCndt', 'image', 'imageUrl', 'content');

$xml = simplexml_load_file('data/nihList.xml');

$count = 0;
foreach ($xml->item as $item) {
    $data = array();
    foreach ($item as $key => $value) {
        $data[$key] = (string)$value;
    }

    $fileName = 'data/detail/' . $data['ccbaKdcd'] . '_' . $data['ccbaCtcd'] . '_' . $data['ccbaAsno'] . '.xml';
    if (file_exists($fileName)) {
        $detail = simplexml_load_file($fileName);
        foreach ($detail as $key => $value) {
            if ($key == 'item') {
                foreach ($value as $key2 => $value2) {
                    $data[$key2] = (string)$value2;
                }
            } else {
                $data[$key] = (string)$value;
            }
        }
    }

    $marks = array();
    $values = array();
    foreach ($fields as $f) {
        $marks[] = '?';
        if (isset($data[$f]) && $data[$f] != '') {
            $values[] = $data[$f];
        } else {
            $values[] = null;
        }
    }

    $sql = "INSERT INTO nih (" . implode(',', $fields) . ") VALUES (" . implode(',', $marks) . ")";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
        $count++;
    } catch (PDOException $e) {
        echo $data['ccbaMnm1'] . ' 오류 : ' . $e->getMessage() . '<br>';
    }
}

echo $count . '건 입력 완료';
