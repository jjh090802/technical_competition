<?php

$pdo = new PDO('mysql:host=localhost;dbname=nihc;charset=utf8mb4', 'root', '');

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
if ($month < 1 || $month > 12) {
    $year = date('Y');
    $month = date('n');
}

$prevYear = $year;
$prevMonth = $month - 1;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear = $year - 1;
}
$nextYear = $year;
$nextMonth = $month + 1;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear = $year + 1;
}

$firstDay = mktime(0, 0, 0, $month, 1, $year);
$lastDay = date('t', $firstDay);
$startWeek = date('w', $firstDay);
$today = date('Y-m-d');

$shows = array();
$stmt = $pdo->prepare("SELECT * FROM show_info WHERE YEAR(showDate) = ? AND MONTH(showDate) = ? ORDER BY showDate, showTime");
$stmt->execute(array($year, $month));
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $day = (int)substr($row['showDate'], 8, 2);
    $shows[$day][] = $row;
}

$pageTitle = '월간 공연 일정';
$gnb = 'show';
$lnb = '공연';
$lnb2 = '월간 공연 일정';
include 'inc/header.php';
?>
            <div class="cal-head">
                <a href="show_month.php?year=<?php echo $prevYear; ?>&month=<?php echo $prevMonth; ?>" class="cal-btn">&lt; 이전 달</a>
                <h3><?php echo $year; ?>년 <?php echo $month; ?>월</h3>
                <a href="show_month.php?year=<?php echo $nextYear; ?>&month=<?php echo $nextMonth; ?>" class="cal-btn">다음 달 &gt;</a>
                <a href="show_form.php?from=month" class="btn btn-main cal-add">일정 등록</a>
            </div>

            <table class="calendar">
                <caption class="blind"><?php echo $year; ?>년 <?php echo $month; ?>월 공연 일정</caption>
                <thead>
                    <tr>
                        <th scope="col" class="sun">일</th>
                        <th scope="col">월</th>
                        <th scope="col">화</th>
                        <th scope="col">수</th>
                        <th scope="col">목</th>
                        <th scope="col">금</th>
                        <th scope="col" class="sat">토</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
<?php
for ($i = 0; $i < $startWeek; $i++) {
    echo '<td class="empty"></td>';
}

$week = $startWeek;
for ($day = 1; $day <= $lastDay; $day++) {
    $date = $year . '-' . sprintf('%02d', $month) . '-' . sprintf('%02d', $day);

    $class = '';
    if ($week == 0) {
        $class = 'sun';
    } else if ($week == 6) {
        $class = 'sat';
    }
    if ($date == $today) {
        $class = $class . ' today';
    }
?>
                        <td class="<?php echo $class; ?>">
                            <span class="day"><?php echo $day; ?></span>
<?php
    if (isset($shows[$day])) {
        foreach ($shows[$day] as $s) {
            $diff = (strtotime($s['showDate']) - strtotime($today)) / 86400;
            if ($diff == 0) {
                $dday = 'D-Day';
            } else if ($diff > 0) {
                $dday = 'D-' . $diff;
            } else {
                $dday = 'D+' . ($diff * -1);
            }
?>
                            <a href="show_form.php?id=<?php echo $s['showUid']; ?>&from=month" class="show <?php if ($s['showDate'] < $today) echo 'past'; ?>" title="<?php echo htmlspecialchars($s['place']); ?>">
                                <b><?php echo substr($s['showTime'], 0, 5); ?></b><?php echo htmlspecialchars($s['showName']); ?>
                                <em class="dday"><?php echo $dday; ?></em>
                            </a>
<?php
        }
    }
?>
                            <a href="show_form.php?from=month&date=<?php echo $date; ?>" class="day-add" title="<?php echo $month; ?>월 <?php echo $day; ?>일 공연 등록">+</a>
                        </td>
<?php
    $week++;
    if ($week == 7 && $day != $lastDay) {
        echo '</tr><tr>';
        $week = 0;
    }
}

for ($i = $week; $i < 7; $i++) {
    echo '<td class="empty"></td>';
}
?>
                    </tr>
                </tbody>
            </table>
            <p class="cal-legend"><span>앞으로 열릴 공연</span><span class="past">지난 공연</span><span class="today-mark">오늘</span></p>

<?php include 'inc/footer.php'; ?>
