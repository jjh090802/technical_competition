<?php 
    session_start(); 
    require "db.php";

    $me = $_SESSION['user'] ?? null;

    function back($msg) {
        echo "<script>alert('$msg'); location.href='housewarming';</script>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!$me) back('로그인 후 이용해 주세요.');
        $action = $_POST['action'] ?? '';

        if ($action === 'write') {
            $knowhow = trim($_POST['knowhow'] ?? '');
            $before  = $_FILES['before'] ?? null;
            $after   = $_FILES['after'] ?? null;

            if ($knowhow === '' || !$before || !$after || $before['error'] !== 0 || $after['error'] !== 0) {
                back('모든 항목을 입력해 주세요.');
            }

            $names = [];
            foreach (['before' => $before, 'after' => $after] as $key => $file) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $name = $key . '_' . uniqid() . '.' . $ext;
                if (!move_uploaded_file($file['tmp_name'], __DIR__ . '/uploads/' . $name)) {
                    back('사진 업로드에 실패했습니다.');
                }
                $names[$key] = $name;
            }

            $stmt = $pdo->prepare("INSERT INTO housewarming (user_idx, before_img, after_img, knowhow) VALUES (?, ?, ?, ?)");
            $stmt->execute([$me['idx'], $names['before'], $names['after'], $knowhow]);
        }

        if ($action === 'score') {
            $postIdx = (int)($_POST['id'] ?? 0);
            $score   = (int)($_POST['score'] ?? 0);
            if ($score < 1 || $score > 5) back('평점을 선택해 주세요.');

            $stmt = $pdo->prepare("SELECT user_idx FROM housewarming WHERE idx = ?");
            $stmt->execute([$postIdx]);
            $post = $stmt->fetch();
            if (!$post) back('존재하지 않는 글입니다.');
            if ($post['user_idx'] == $me['idx']) back('본인 글에는 평점을 줄 수 없습니다.');

            $stmt = $pdo->prepare("SELECT COUNT(*) FROM housewarming_rating WHERE post_idx = ? AND user_idx = ?");
            $stmt->execute([$postIdx, $me['idx']]);
            if ($stmt->fetchColumn() > 0) back('이미 평점을 준 글입니다.');

            $stmt = $pdo->prepare("INSERT INTO housewarming_rating (post_idx, user_idx, score) VALUES (?, ?, ?)");
            $stmt->execute([$postIdx, $me['idx'], $score]);
        }

        header('Location: housewarming');
        exit;
    }

    $stmt = $pdo->prepare("
        SELECT h.*, u.name, u.userid,
               FLOOR(IFNULL(AVG(r.score), 0)) AS avg_score,
               SUM(r.user_idx = ?) AS rated
        FROM housewarming h
        JOIN users u ON u.idx = h.user_idx
        LEFT JOIN housewarming_rating r ON r.post_idx = h.idx
        GROUP BY h.idx
        ORDER BY h.idx DESC
    ");
    $stmt->execute([$me['idx'] ?? 0]);
    $posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>내집꾸미기</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- 헤더: 로그인 상태에 따라 [로그인·회원가입] ↔ [이름(아이디)·로그아웃] -->
    <header class="header">
        <div class="inner">
            <h1 class="logo"><a href="./"><img src="images/logo.png" alt="내집꾸미기" title="내집꾸미기"></a></h1>

            <nav class="menu">
                <span class="menu-icon" title="메뉴 보기"><i></i></span>
                <ul class="gnb">
                    <li><a href="./">홈</a></li>
                    <li><a href="housewarming" class="on">온라인 집들이</a></li>
                    <li><a href="store">스토어</a></li>
                    <li><a href="specialist">전문가</a></li>
                    <li><a href="estimate">시공 견적</a></li>
                </ul>
            </nav>

            <div class="util">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="me">
                        <?php if (!empty($_SESSION['user']['photo'])): ?>
                            <img src="<?= htmlspecialchars($_SESSION['user']['photo']) ?>" alt="내 사진" title="내 사진">
                        <?php endif; ?>
                        <?= htmlspecialchars($_SESSION['user']['name']) ?>(<?= htmlspecialchars($_SESSION['user']['userid']) ?>)
                    </span>
                    <a href="logout">로그아웃</a>
                <?php else: ?>
                    <a href="./">로그인</a>
                    <a href="./" class="join">회원가입</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- 페이지 제목 -->
    <section class="sub-visual">
        <div class="inner">
            <p class="en">ONLINE HOUSEWARMING</p>
            <h2>온라인 집들이</h2>
            <p>우리 집의 Before & After 사진과 인테리어 노하우를 나눠 보세요.</p>
        </div>
    </section>

    <section class="board">
        <div class="inner">
            <div class="board-top">
                <p>전체 <b><?= count($posts) ?></b>개</p>
                <button type="button" class="btn" data-open="#writeModal">글쓰기</button>
            </div>

            <!-- 게시 글 목록 -->
            <ul class="house-board">
                <?php foreach ($posts as $p): $avg = (int)$p['avg_score']; ?>
                    <li>
                        <div class="ba">
                            <figure><img src="uploads/<?= htmlspecialchars($p['before_img']) ?>" alt="Before 사진" title="Before"><figcaption>BEFORE</figcaption></figure>
                            <figure><img src="uploads/<?= htmlspecialchars($p['after_img']) ?>" alt="After 사진" title="After"><figcaption class="after-tag">AFTER</figcaption></figure>
                        </div>
                        <div class="txt">
                            <p class="name"><?= htmlspecialchars($p['name']) ?>(<?= htmlspecialchars($p['userid']) ?>) <span><?= substr($p['created_at'], 0, 10) ?></span></p>
                            <p class="desc"><?= nl2br(htmlspecialchars($p['knowhow'])) ?></p>
                            <p class="score"><span class="star"><?= str_repeat('★', $avg) . str_repeat('☆', 5 - $avg) ?></span> 평점 <b><?= $avg ?></b></p>
                            <?php if ($me && $p['user_idx'] != $me['idx'] && !$p['rated']): ?>
                                <button type="button" class="btn small" data-open="#scoreModal" data-id="<?= $p['idx'] ?>">평점 주기</button>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
                    </div>
    </section>

    <!-- 글쓰기 모달 -->
    <dialog class="modal" id="writeModal">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="write">
            <h3>집들이 글쓰기</h3>
            <label>Before 사진 <input type="file" name="before" accept="image/*" required></label>
            <label>After 사진 <input type="file" name="after" accept="image/*" required></label>
            <label>노하우 <textarea name="knowhow" rows="5" required></textarea></label>
            <div class="buttons">
                <button type="submit" class="btn">작성 완료</button>
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </form>
    </dialog>

    <!-- 평점 주기 모달: 숫자 버튼을 누르면 바로 저장되고 페이지가 새로 열리며 닫힌다 -->
    <dialog class="modal" id="scoreModal">
        <form method="post">
            <input type="hidden" name="action" value="score">
            <input type="hidden" name="id">
            <h3>평점 주기</h3>
            <div class="score-buttons">
                                    <button type="submit" name="score" value="1">1</button>
                                    <button type="submit" name="score" value="2">2</button>
                                    <button type="submit" name="score" value="3">3</button>
                                    <button type="submit" name="score" value="4">4</button>
                                    <button type="submit" name="score" value="5">5</button>
                            </div>
            <div class="buttons">
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </form>
    </dialog>

    <!-- 푸터: 카피라이트 -->
    <footer class="footer">
        <div class="inner">
            <img src="images/logo_white.png" alt="내집꾸미기" title="내집꾸미기">
            <p>COPYRIGHT ⓒ 2020 내집꾸미기. ALL RIGHTS RESERVED.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
