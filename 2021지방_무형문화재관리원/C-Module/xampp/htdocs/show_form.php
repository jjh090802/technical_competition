<?php

$pdo = new PDO('mysql:host=localhost;dbname=nihc;charset=utf8mb4', 'root', '');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$from = isset($_GET['from']) ? $_GET['from'] : 'month';
if ($from != 'year') {
    $from = 'month';
}

$row = null;
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM show_info WHERE showUid = ?");
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo "<script>alert('없는 공연입니다.'); location.href='show_$from.php';</script>";
        exit;
    }
    $showName = $row['showName'];
    $showDate = $row['showDate'];
    $showTime = substr($row['showTime'], 0, 5);
    $organizer = $row['organizer'];
    $place = $row['place'];
    $cast = $row['cast'];
    $rm = $row['rm'];
} else {
    $showName = '';
    $showDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
    $showTime = '14:00';
    $organizer = '무형문화재관리원';
    $place = '';
    $cast = '';
    $rm = '';
}

$error = '';
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'delete' && $row) {
    $stmt = $pdo->prepare("DELETE FROM show_info WHERE showUid = ?");
    $stmt->execute(array($id));
    if ($from == 'year') {
        $url = 'show_year.php?year=' . substr($row['showDate'], 0, 4);
    } else {
        $url = 'show_month.php?year=' . substr($row['showDate'], 0, 4) . '&month=' . (int)substr($row['showDate'], 5, 2);
    }
    echo "<script>alert('삭제되었습니다.'); location.href='$url';</script>";
    exit;
}

if ($action == 'save') {
    $showName = trim($_POST['showName']);
    $showDate = trim($_POST['showDate']);
    $showTime = trim($_POST['showTime']);
    $organizer = trim($_POST['organizer']);
    $place = trim($_POST['place']);
    $cast = trim($_POST['cast']);
    $rm = trim($_POST['rm']);

    if ($showName == '') {
        $error = '공연명을 입력해주세요.';
    } else if ($showDate == '' || !strtotime($showDate)) {
        $error = '공연일을 입력해주세요.';
    } else if ($showTime == '') {
        $error = '공연시간을 입력해주세요.';
    }

    if ($error == '') {
        if ($row) {
            $stmt = $pdo->prepare("UPDATE show_info SET showName = ?, showDate = ?, showTime = ?, organizer = ?, place = ?, `cast` = ?, rm = ?, updtDt = NOW() WHERE showUid = ?");
            $stmt->execute(array($showName, $showDate, $showTime, $organizer, $place, $cast, $rm, $id));
            echo "<script>alert('수정되었습니다.'); location.href='show_form.php?id=$id&from=$from';</script>";
            exit;
        } else {
            $stmt = $pdo->prepare("INSERT INTO show_info (showName, showDate, showTime, organizer, place, `cast`, rm, registDt) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute(array($showName, $showDate, $showTime, $organizer, $place, $cast, $rm));
            $time = strtotime($showDate);
            if ($from == 'year') {
                $url = 'show_year.php?year=' . date('Y', $time);
            } else {
                $url = 'show_month.php?year=' . date('Y', $time) . '&month=' . date('n', $time);
            }
            echo "<script>alert('등록되었습니다.'); location.href='$url';</script>";
            exit;
        }
    }
}

$time = strtotime($showDate);
if (!$time) {
    $time = time();
}
if ($from == 'year') {
    $listUrl = 'show_year.php?year=' . date('Y', $time);
} else {
    $listUrl = 'show_month.php?year=' . date('Y', $time) . '&month=' . date('n', $time);
}

if ($row) {
    $pageTitle = '공연 수정';
} else {
    $pageTitle = '공연 등록';
}
$gnb = 'show';
$lnb = '공연';
if ($from == 'year') {
    $lnb2 = '연간 공연 일정';
} else {
    $lnb2 = '월간 공연 일정';
}
$crumb = $pageTitle;
include 'inc/header.php';
?>
<?php if ($error != '') { ?>
            <script>alert('<?php echo $error; ?>');</script>
<?php } ?>
            <form class="form" method="post" action="show_form.php?<?php if ($id > 0) echo 'id=' . $id . '&'; ?>from=<?php echo $from; ?>">
                <input type="hidden" name="action" value="save">
                <p class="form-note"><b>*</b> 표시는 꼭 입력해야 하는 항목입니다.</p>
                <fieldset>
                    <legend>공연 정보</legend>
                    <div class="form-grid">
                        <p class="wide">
                            <label for="showName">공연명 <b>*</b> <small>showName</small></label>
                            <input type="text" id="showName" name="showName" value="<?php echo htmlspecialchars($showName); ?>" placeholder="신노이" required>
                        </p>
                        <p>
                            <label for="showDate">공연일 <b>*</b> <small>showDate</small></label>
                            <input type="date" id="showDate" name="showDate" value="<?php echo htmlspecialchars($showDate); ?>" required>
                        </p>
                        <p>
                            <label for="showTime">공연시간 <b>*</b> <small>showTime</small></label>
                            <input type="time" id="showTime" name="showTime" value="<?php echo htmlspecialchars($showTime); ?>" required>
                        </p>
                        <p>
                            <label for="organizer">주관 <small>organizer</small></label>
                            <input type="text" id="organizer" name="organizer" value="<?php echo htmlspecialchars($organizer ?? ''); ?>" placeholder="무형문화재관리원">
                        </p>
                        <p>
                            <label for="place">공연장소 <small>place</small></label>
                            <input type="text" id="place" name="place" value="<?php echo htmlspecialchars($place ?? ''); ?>" placeholder="얼쑤마루">
                        </p>
                        <p class="wide">
                            <label for="cast">출연진 <small>cast</small></label>
                            <input type="text" id="cast" name="cast" value="<?php echo htmlspecialchars($cast ?? ''); ?>" placeholder="미정">
                        </p>
                        <p class="wide">
                            <label for="rm">공연내용 <small>rm</small></label>
                            <textarea id="rm" name="rm" rows="5"><?php echo htmlspecialchars($rm ?? ''); ?></textarea>
                        </p>
<?php
if ($row) {
    $diff = (strtotime($row['showDate']) - strtotime(date('Y-m-d'))) / 86400;
    if ($diff == 0) {
        $dday = 'D-Day';
    } else if ($diff > 0) {
        $dday = 'D-' . $diff;
    } else {
        $dday = 'D+' . ($diff * -1);
    }
?>
                        <p>
                            <span class="label">등록일 <small>registDt</small></span>
                            <span class="read"><?php echo $row['registDt']; ?></span>
                        </p>
                        <p>
                            <span class="label">수정일 <small>updtDt</small></span>
                            <span class="read"><?php if ($row['updtDt'] != '') echo $row['updtDt']; else echo '-'; ?></span>
                        </p>
                        <p>
                            <span class="label">공연 고유번호 <small>showUid</small></span>
                            <span class="read"><?php echo $row['showUid']; ?> (<?php echo $dday; ?>)</span>
                        </p>
<?php } ?>
                    </div>
                </fieldset>

                <div class="form-btns">
                    <a href="<?php echo $listUrl; ?>" class="btn">목록</a>
                    <?php if ($row) { ?>
                    <button type="submit" form="deleteForm" class="btn btn-del">삭제</button>
                    <button type="submit" class="btn btn-main">수정</button>
                    <?php } else { ?>
                    <button type="submit" class="btn btn-main">등록</button>
                    <?php } ?>
                </div>
            </form>

<?php if ($row) { ?>
            <form id="deleteForm" method="post" action="show_form.php?id=<?php echo $id; ?>&from=<?php echo $from; ?>" onsubmit="return confirm('이 공연을 삭제하시겠습니까?')">
                <input type="hidden" name="action" value="delete">
            </form>
<?php } ?>

<?php include 'inc/footer.php'; ?>
