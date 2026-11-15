<?php

$pdo = new PDO('mysql:host=localhost;dbname=nihc;charset=utf8mb4', 'root', '');

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$today = date('Y-m-d');

$shows = array();
$stmt = $pdo->prepare("SELECT * FROM show_info WHERE YEAR(showDate) = ? ORDER BY showDate, showTime");
$stmt->execute(array($year));
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $month = (int)substr($row['showDate'], 5, 2);
    $shows[$month][] = $row;
}

$pageTitle = '연간 공연 일정';
$gnb = 'show';
$lnb = '공연';
$lnb2 = '연간 공연 일정';
include 'inc/header.php';
?>
            <div class="cal-head">
                <a href="show_year.php?year=<?php echo $year - 1; ?>" class="cal-btn">&lt; 이전 해</a>
                <h3><?php echo $year; ?>년</h3>
                <a href="show_year.php?year=<?php echo $year + 1; ?>" class="cal-btn">다음 해 &gt;</a>
                <a href="show_form.php?from=year" class="btn btn-main cal-add">일정 등록</a>
            </div>

            <div class="year-list">
<?php for ($i = 1; $i <= 12; $i++) { ?>
                <section class="month <?php if ($year == date('Y') && $i == date('n')) echo 'now'; ?>">
                    <h4><?php echo $i; ?><small>월</small></h4>
<?php if (!isset($shows[$i])) { ?>
                    <p class="none">등록된 공연이 없습니다.</p>
<?php } else { ?>
                    <ul>
<?php
    foreach ($shows[$i] as $s) {
        $diff = (strtotime($s['showDate']) - strtotime($today)) / 86400;
        if ($diff == 0) {
            $dday = 'D-Day';
        } else if ($diff > 0) {
            $dday = 'D-' . $diff;
        } else {
            $dday = 'D+' . ($diff * -1);
        }
?>
                        <li class="<?php if ($s['showDate'] < $today) echo 'past'; ?>">
                            <span class="date"><?php echo substr($s['showDate'], 5, 2); ?>. <?php echo substr($s['showDate'], 8, 2); ?></span>
                            <span class="time"><?php echo substr($s['showTime'], 0, 5); ?></span>
                            <a href="show_form.php?id=<?php echo $s['showUid']; ?>&from=year"><?php echo htmlspecialchars($s['showName']); ?></a>
                            <em class="dday"><?php echo $dday; ?></em>
                        </li>
<?php } ?>
                    </ul>
<?php } ?>
                </section>
<?php } ?>
            </div>

<?php include 'inc/footer.php'; ?>
