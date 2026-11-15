<?php

$pdo = new PDO('mysql:host=localhost;dbname=nihc;charset=utf8mb4', 'root', '');

$bcodeList = array('전통 공연·예술', '전통기술', '전통지식', '구전 전통 및 표현', '전통 생활관습', '의례·의식', '전통 놀이·무예');
$imgDir = 'C:/xampp/nihcImage/';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$view = isset($_GET['view']) ? $_GET['view'] : 'album';
$bcode = isset($_GET['bcode']) ? $_GET['bcode'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($view != 'list') {
    $view = 'album';
}
if (!in_array($bcode, $bcodeList)) {
    $bcode = '';
}

$query = "view=" . urlencode($view) . "&bcode=" . urlencode($bcode) . "&page=" . $page;

$groups = array(
    '기본 정보' => array(
        'ccbaMnm1' => '문화재명(국문)',
        'ccbaMnm2' => '문화재명(한자)',
        'ccmaName' => '문화재종목',
        'crltsnoNm' => '지정호수',
        'ccbaKdcd' => '종목코드',
        'ccbaCtcd' => '시도코드',
        'ccbaAsno' => '지정번호',
        'ccbaCpno' => '연계번호',
    ),
    '분류' => array(
        'gcodeName' => '문화재분류',
        'bcodeName' => '문화재분류2(종류)',
        'mcodeName' => '문화재분류3',
        'scodeName' => '문화재분류4',
    ),
    '지정 · 소재지' => array(
        'ccbaAsdt' => '지정(등록일)',
        'ccceName' => '시대',
        'ccbaCtcdNm' => '시도명',
        'ccsiName' => '시군구명',
        'ccbaLcad' => '소재지 상세',
        'ccbaQuan' => '수량',
        'longitude' => '경도',
        'latitude' => '위도',
    ),
    '관리' => array(
        'ccbaPoss' => '소유자',
        'ccbaAdmin' => '관리자',
        'ccbaCncl' => '지정해제여부',
        'ccbaCndt' => '지정해제일',
    ),
);
$required = array('ccbaMnm1', 'ccmaName', 'crltsnoNm', 'ccbaKdcd', 'ccbaCtcd', 'ccbaAsno');
$placeholder = array(
    'ccbaMnm1' => '봉산탈춤', 'ccbaMnm2' => '鳳山탈춤', 'ccmaName' => '국가무형문화재', 'crltsnoNm' => '17',
    'ccbaKdcd' => '17', 'ccbaCtcd' => '11', 'ccbaAsno' => '00170000', 'ccbaCpno' => '1271100170000',
    'gcodeName' => '무형문화재', 'mcodeName' => '연희', 'ccbaAsdt' => '19670616', 'ccbaCtcdNm' => '서울특별시',
    'ccbaLcad' => '서울특별시', 'longitude' => '0', 'latitude' => '0', 'ccbaAdmin' => '(사)봉산탈춤보존회',
);

$fields = array();
foreach ($groups as $g) {
    foreach ($g as $name => $label) {
        $fields[$name] = $label;
    }
}
$fields['content'] = '설명';

$row = null;
$data = array();
foreach ($fields as $name => $label) {
    $data[$name] = '';
}

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM nih WHERE id = ?");
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo "<script>alert('없는 무형문화재입니다.'); location.href='nih.php?$query';</script>";
        exit;
    }
    foreach ($fields as $name => $label) {
        $data[$name] = $row[$name];
    }
} else {
    $data['ccbaKdcd'] = '17';
    $data['ccmaName'] = '국가무형문화재';
    $data['gcodeName'] = '무형문화재';
    $data['bcodeName'] = $bcode;
    $data['ccbaCncl'] = 'N';
    $data['longitude'] = '0';
    $data['latitude'] = '0';
}

$error = '';
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'delete' && $row) {
    $stmt = $pdo->prepare("DELETE FROM nih WHERE id = ?");
    $stmt->execute(array($id));
    if ($row['image'] != '' && file_exists($imgDir . $row['image'])) {
        unlink($imgDir . $row['image']);
    }
    echo "<script>alert('삭제되었습니다.'); location.href='nih.php?$query';</script>";
    exit;
}

if ($action == 'save') {
    foreach ($fields as $name => $label) {
        $data[$name] = isset($_POST[$name]) ? trim($_POST[$name]) : '';
    }

    foreach ($required as $name) {
        if ($data[$name] == '') {
            $error = $fields[$name] . '을(를) 입력해주세요.';
            break;
        }
    }

    if ($error == '') {
        $stmt = $pdo->prepare("SELECT id FROM nih WHERE ccbaKdcd = ? AND ccbaCtcd = ? AND ccbaAsno = ? AND id != ?");
        $stmt->execute(array($data['ccbaKdcd'], $data['ccbaCtcd'], $data['ccbaAsno'], $id));
        if ($stmt->fetch()) {
            $error = '이미 등록된 종목코드, 시도코드, 지정번호입니다.';
        }
    }

    $newImage = '';
    if ($error == '' && isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif') {
            $error = '이미지는 jpg, png, gif 파일만 올릴 수 있습니다.';
        } else {
            $newImage = time() . '_' . rand(1000, 9999) . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], $imgDir . $newImage);
        }
    }

    if ($error == '') {
        $sql = "";
        $params = array();
        foreach ($fields as $name => $label) {
            if ($sql != '') {
                $sql .= ", ";
            }
            $sql .= "$name = ?";
            if ($data[$name] == '') {
                $params[] = null;
            } else {
                $params[] = $data[$name];
            }
        }
        if ($newImage != '') {
            $sql .= ", image = ?, imageUrl = ?";
            $params[] = $newImage;
            $params[] = $newImage;
        }

        if ($row) {
            $params[] = $id;
            $stmt = $pdo->prepare("UPDATE nih SET $sql WHERE id = ?");
            $stmt->execute($params);
            if ($newImage != '' && $row['image'] != '' && file_exists($imgDir . $row['image'])) {
                unlink($imgDir . $row['image']);
            }
            echo "<script>alert('수정되었습니다.'); location.href='nih_form.php?id=$id&$query';</script>";
            exit;
        } else {
            $stmt = $pdo->prepare("INSERT INTO nih SET $sql");
            $stmt->execute($params);
            echo "<script>alert('등록되었습니다.'); location.href='nih.php?view=" . urlencode($view) . "&bcode=" . urlencode($bcode) . "';</script>";
            exit;
        }
    }
}

if ($row) {
    $pageTitle = '무형문화재 수정';
} else {
    $pageTitle = '무형문화재 등록';
}
$gnb = 'nih';
if ($bcode != '') {
    $lnb = $bcode;
} else {
    $lnb = '전체 현황';
}
$crumb = $pageTitle;
include 'inc/header.php';
?>
<?php if ($error != '') { ?>
            <script>alert('<?php echo $error; ?>');</script>
<?php } ?>
            <form class="form" method="post" action="nih_form.php?<?php if ($id > 0) echo 'id=' . $id . '&'; ?><?php echo $query; ?>" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <p class="form-note"><b>*</b> 표시는 꼭 입력해야 하는 항목입니다. 칸 이름 옆의 영문은 전문(XML)의 항목명입니다.</p>

                <?php foreach ($groups as $legend => $items) { ?>
                <fieldset>
                    <legend><?php echo $legend; ?></legend>
                    <div class="form-grid">
                        <?php foreach ($items as $name => $label) { ?>
                        <p>
                            <label for="<?php echo $name; ?>"><?php echo $label; ?> <?php if (in_array($name, $required)) echo '<b>*</b>'; ?> <small><?php echo $name; ?></small></label>
                            <?php if ($name == 'bcodeName') { ?>
                            <select id="bcodeName" name="bcodeName">
                                <option value="">선택</option>
                                <?php foreach ($bcodeList as $b) { ?>
                                <option <?php if ($data['bcodeName'] == $b) echo 'selected'; ?>><?php echo $b; ?></option>
                                <?php } ?>
                            </select>
                            <?php } else if ($name == 'ccbaCncl') { ?>
                            <select id="ccbaCncl" name="ccbaCncl">
                                <option value="N">N (지정 중)</option>
                                <option value="Y" <?php if ($data['ccbaCncl'] == 'Y') echo 'selected'; ?>>Y (지정 해제)</option>
                            </select>
                            <?php } else { ?>
                            <input type="text" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo htmlspecialchars($data[$name] ?? ''); ?>" placeholder="<?php if (isset($placeholder[$name])) echo $placeholder[$name]; ?>" <?php if (in_array($name, $required)) echo 'required'; ?>>
                            <?php } ?>
                        </p>
                        <?php } ?>
                    </div>
                </fieldset>
                <?php } ?>
                <fieldset>
                    <legend>그림 · 설명</legend>
                    <div class="form-grid">
                        <p class="wide">
                            <label for="image">이미지 <small>image</small></label>
                            <span class="file-box">
                                <?php if ($row && $row['image'] != '' && file_exists($imgDir . $row['image'])) { ?>
                                <img src="image.php?file=<?php echo $row['image']; ?>" alt="지금 그림" title="지금 그림" class="preview">
                                <?php } ?>
                                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif">
                                <small><?php if ($row) echo '새 그림을 고르면 바뀝니다. '; ?>jpg, png, gif 파일 · xampp\nihcImage 폴더에 저장됩니다.</small>
                            </span>
                        </p>
                        <p class="wide">
                            <label for="content">설명 <small>content</small></label>
                            <textarea id="content" name="content" rows="6" placeholder="탈춤이란…"><?php echo htmlspecialchars($data['content'] ?? ''); ?></textarea>
                        </p>
                    </div>
                </fieldset>

                <div class="form-btns">
                    <a href="nih.php?<?php echo $query; ?>" class="btn">목록</a>
                    <?php if ($row) { ?>
                    <button type="submit" form="deleteForm" class="btn btn-del">삭제</button>
                    <button type="submit" class="btn btn-main">수정</button>
                    <?php } else { ?>
                    <button type="submit" class="btn btn-main">등록</button>
                    <?php } ?>
                </div>
            </form>

<?php if ($row) { ?>
            <form id="deleteForm" method="post" action="nih_form.php?id=<?php echo $id; ?>&<?php echo $query; ?>" onsubmit="return confirm('이 무형문화재를 삭제하시겠습니까? 그림 파일도 함께 지워집니다.')">
                <input type="hidden" name="action" value="delete">
            </form>
<?php } ?>

<?php include 'inc/footer.php'; ?>
