<?php

$pdo = new PDO('mysql:host=localhost;dbname=nihc;charset=utf8mb4', 'root', '');

$bcodeList = array('전통 공연·예술', '전통기술', '전통지식', '구전 전통 및 표현', '전통 생활관습', '의례·의식', '전통 놀이·무예');

$view = isset($_GET['view']) ? $_GET['view'] : 'album';
$bcode = isset($_GET['bcode']) ? $_GET['bcode'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($view != 'list') {
    $view = 'album';
}
if (!in_array($bcode, $bcodeList)) {
    $bcode = '';
}

if ($view == 'album') {
    $limit = 8;
} else {
    $limit = 10;
}

$where = "";
$params = array();
if ($bcode != '') {
    $where = "WHERE bcodeName = ?";
    $params[] = $bcode;
}

$stmt = $pdo->prepare("SELECT COUNT(*) FROM nih $where");
$stmt->execute($params);
$total = $stmt->fetchColumn();

$totalPage = ceil($total / $limit);
if ($totalPage < 1) {
    $totalPage = 1;
}
if ($page < 1) {
    $page = 1;
}
if ($page > $totalPage) {
    $page = $totalPage;
}

$start = ($page - 1) * $limit;
$stmt = $pdo->prepare("SELECT * FROM nih $where ORDER BY id LIMIT $start, $limit");
$stmt->execute($params);
$list = $stmt->fetchAll(PDO::FETCH_ASSOC);

$startPage = floor(($page - 1) / 10) * 10 + 1;
$endPage = $startPage + 9;
if ($endPage > $totalPage) {
    $endPage = $totalPage;
}

$prevPage = $page - 1;
if ($prevPage < 1) {
    $prevPage = 1;
}
$nextPage = $page + 1;
if ($nextPage > $totalPage) {
    $nextPage = $totalPage;
}

$query = "view=" . $view . "&bcode=" . urlencode($bcode);

if ($bcode != '') {
    $pageTitle = $bcode;
} else {
    $pageTitle = '전체 현황';
}
$gnb = 'nih';
$lnb = $pageTitle;
include 'inc/header.php';
?>
            <div class="list-top">
                <p class="count">총 <b><?php echo $total; ?></b>건 · <b><?php echo $page; ?></b> / <?php echo $totalPage; ?> 페이지</p>
                <p class="view-btns">
                    <a href="nih.php?view=album&bcode=<?php echo urlencode($bcode); ?>" class="<?php if ($view == 'album') echo 'on'; ?>">앨범</a>
                    <a href="nih.php?view=list&bcode=<?php echo urlencode($bcode); ?>" class="<?php if ($view == 'list') echo 'on'; ?>">목록</a>
                </p>
            </div>
            <p class="tool-right"><a href="nih_form.php?<?php echo $query; ?>&page=<?php echo $page; ?>" class="btn btn-main">등록</a></p>

<?php if ($total == 0) { ?>
            <p class="empty">등록된 무형문화재가 없습니다.</p>
<?php } else if ($view == 'album') { ?>
            <ul class="album">
                <?php foreach ($list as $row) { ?>
                <li>
                    <a href="nih_form.php?id=<?php echo $row['id']; ?>&<?php echo $query; ?>&page=<?php echo $page; ?>" class="photo">
                        <?php if ($row['image'] != '' && file_exists('C:/xampp/nihcImage/' . $row['image'])) { ?>
                        <img src="image.php?file=<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['ccbaMnm1']); ?>" title="<?php echo htmlspecialchars($row['ccbaMnm1']); ?>">
                        <?php } else { ?>
                        <span class="noimg"><span>no image</span><small>이미지 준비 중</small></span>
                        <?php } ?>
                    </a>
                    <strong><a href="nih_form.php?id=<?php echo $row['id']; ?>&<?php echo $query; ?>&page=<?php echo $page; ?>"><?php echo htmlspecialchars($row['ccbaMnm1']); ?></a></strong>
                    <p><?php echo htmlspecialchars($row['ccmaName']); ?> 제<?php echo htmlspecialchars($row['crltsnoNm']); ?>호 · <?php echo htmlspecialchars($row['ccbaCtcdNm'] . ' ' . $row['ccsiName']); ?></p>
                </li>
                <?php } ?>
            </ul>
<?php } else { ?>
            <table class="board">
                <caption class="blind">무형문화재 목록</caption>
                <thead>
                    <tr>
                        <th scope="col">순번</th>
                        <th scope="col">문화재명</th>
                        <th scope="col">문화재 종목</th>
                        <th scope="col">지정호수</th>
                        <th scope="col">소재지</th>
                        <th scope="col" class="hide-m">분류</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = $start + 1;
                    foreach ($list as $row) {
                    ?>
                    <tr>
                        <td><?php echo $num; ?></td>
                        <td class="name"><a href="nih_form.php?id=<?php echo $row['id']; ?>&<?php echo $query; ?>&page=<?php echo $page; ?>"><?php echo htmlspecialchars($row['ccbaMnm1']); ?></a></td>
                        <td><?php echo htmlspecialchars($row['ccmaName']); ?></td>
                        <td>제<?php echo htmlspecialchars($row['crltsnoNm']); ?>호</td>
                        <td><?php echo htmlspecialchars($row['ccbaCtcdNm'] . ' ' . $row['ccsiName']); ?></td>
                        <td class="hide-m"><?php echo htmlspecialchars($row['bcodeName']); ?></td>
                    </tr>
                    <?php
                        $num++;
                    }
                    ?>
                </tbody>
            </table>
<?php } ?>

            <p class="paging">
                <a href="nih.php?<?php echo $query; ?>&page=1" title="처음 페이지">&lt;&lt;</a>
                <a href="nih.php?<?php echo $query; ?>&page=<?php echo $prevPage; ?>" title="이전 페이지">&lt;</a>
                <?php
                for ($i = $startPage; $i <= $endPage; $i++) {
                    if ($i == $page) {
                        echo '<strong title="현재 페이지">' . $i . '</strong>';
                    } else {
                        echo '<a href="nih.php?' . $query . '&page=' . $i . '">' . $i . '</a>';
                    }
                }
                ?>
                <a href="nih.php?<?php echo $query; ?>&page=<?php echo $nextPage; ?>" title="다음 페이지">&gt;</a>
                <a href="nih.php?<?php echo $query; ?>&page=<?php echo $totalPage; ?>" title="마지막 페이지">&gt;&gt;</a>
            </p>

<?php include 'inc/footer.php'; ?>
