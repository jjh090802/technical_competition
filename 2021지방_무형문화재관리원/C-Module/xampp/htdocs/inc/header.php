<?php
if (!isset($pageTitle)) $pageTitle = '';
if (!isset($gnb)) $gnb = '';
if (!isset($lnb)) $lnb = '';
if (!isset($lnb2)) $lnb2 = '';
if (!isset($crumb)) $crumb = '';

$gnbName = '';
$gnbDesc = '';
$svClass = '';
if ($gnb == 'about') {
    $gnbName = '무형문화재관리원';
    $gnbDesc = '무형유산을 지키고 잇는 사람들';
    $svClass = 'sv-about';
} else if ($gnb == 'nih') {
    $gnbName = '무형문화재 현황';
    $gnbDesc = '분야별로 만나는 우리 무형문화재';
} else if ($gnb == 'show') {
    $gnbName = '행사 안내';
    $gnbDesc = '공연·전시·교육 일정을 한눈에';
    $svClass = 'sv-show';
} else if ($gnb == 'open') {
    $gnbName = '공개 데이터';
    $gnbDesc = '누구나 쓰는 무형유산 정보';
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if ($pageTitle != '') echo $pageTitle . ' | '; ?>무형문화재관리원</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="topbar">
            <div class="inner">
                <p class="slogan">무형유산의 가치를 국민과 함께 나눕니다</p>
                <ul class="util">
                    <li><a href="#">로그인</a></li>
                    <li><a href="#">회원가입</a></li>
                    <li><a href="#">문의하기</a></li>
                </ul>
                <div class="lang">
                    <a href="#" class="lang-now">한국어</a>
                    <ul>
                        <li><a href="#" lang="ko">한국어</a></li>
                        <li><a href="#" lang="en">English</a></li>
                        <li><a href="#" lang="zh-Hans">中文(简体)</a></li>
                        <li><a href="#" lang="ja">日本語</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="inner navbar">
            <h1 class="logo"><a href="index.php"><img src="images/logo.svg" alt="무형문화재관리원" title="무형문화재관리원"></a></h1>

            <input type="checkbox" id="menu-open" class="menu-open">
            <label for="menu-open" class="menu-btn"><span>메뉴 열기</span></label>

            <nav class="gnb">
                <ul>
                    <li>
                        <a href="history.php">무형문화재관리원</a>
                        <div class="sub">
                            <div class="inner">
                                <p class="sub-title"><strong>무형문화재관리원</strong>무형유산을 지키고 잇는 사람들</p>
                                <ul>
                                    <li><a href="#">소개</a></li>
                                    <li>
                                        <a href="history.php">일반현황</a>
                                        <ul>
                                            <li><a href="#">설립목적</a></li>
                                            <li><a href="history.php">연혁</a></li>
                                            <li><a href="#">역할</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">주요업무계획</a></li>
                                    <li><a href="#">조직 및 구성</a></li>
                                    <li><a href="phone.php">전화번호</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="nih.php">무형문화재 현황</a>
                        <div class="sub">
                            <div class="inner">
                                <p class="sub-title"><strong>무형문화재 현황</strong>분야별로 만나는 우리 무형문화재</p>
                                <ul>
                                    <li><a href="nih.php?bcode=%EC%A0%84%ED%86%B5+%EA%B3%B5%EC%97%B0%C2%B7%EC%98%88%EC%88%A0">전통 공연·예술</a></li>
                                    <li><a href="nih.php?bcode=%EC%A0%84%ED%86%B5%EA%B8%B0%EC%88%A0">전통기술</a></li>
                                    <li><a href="nih.php?bcode=%EC%A0%84%ED%86%B5%EC%A7%80%EC%8B%9D">전통지식</a></li>
                                    <li><a href="nih.php?bcode=%EA%B5%AC%EC%A0%84+%EC%A0%84%ED%86%B5+%EB%B0%8F+%ED%91%9C%ED%98%84">구전 전통 및 표현</a></li>
                                    <li><a href="nih.php?bcode=%EC%A0%84%ED%86%B5+%EC%83%9D%ED%99%9C%EA%B4%80%EC%8A%B5">전통 생활관습</a></li>
                                    <li><a href="nih.php?bcode=%EC%9D%98%EB%A1%80%C2%B7%EC%9D%98%EC%8B%9D">의례·의식</a></li>
                                    <li><a href="nih.php?bcode=%EC%A0%84%ED%86%B5+%EB%86%80%EC%9D%B4%C2%B7%EB%AC%B4%EC%98%88">전통 놀이·무예</a></li>
                                    <li><a href="nih.php">전체 현황</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="show_month.php">행사 안내</a>
                        <div class="sub">
                            <div class="inner">
                                <p class="sub-title"><strong>행사 안내</strong>공연·전시·교육 일정을 한눈에</p>
                                <ul>
                                    <li>
                                        <a href="show_month.php">공연</a>
                                        <ul>
                                            <li><a href="show_month.php">월간 공연 일정</a></li>
                                            <li><a href="show_year.php">연간 공연 일정</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">전시</a>
                                        <ul>
                                            <li><a href="#">관람 안내</a></li>
                                            <li><a href="#">전시실</a></li>
                                            <li><a href="#">디지털 체험관</a></li>
                                            <li><a href="#">기획 전시실</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">교육</a>
                                        <ul>
                                            <li><a href="#">전문 교육</a></li>
                                            <li><a href="#">사회 교육</a></li>
                                            <li><a href="#">연간 교육일정</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#">전승지원</a>
                        <div class="sub">
                            <div class="inner">
                                <p class="sub-title"><strong>전승지원</strong>장인의 손끝을 다음 세대로</p>
                                <ul>
                                    <li><a href="#">공방</a></li>
                                    <li><a href="#">공예품 갤러리</a></li>
                                    <li><a href="#">전수교육관 현황</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="open_nih.php">공개 데이터</a>
                        <div class="sub">
                            <div class="inner">
                                <p class="sub-title"><strong>공개 데이터</strong>누구나 쓰는 무형유산 정보</p>
                                <ul>
                                    <li><a href="open_nih.php">무형문화재 현황 조회</a></li>
                                    <li><a href="open_show.php">공연 일정 조회</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
<?php if ($gnb != '') { ?>

    <div class="sub-visual <?php echo $svClass; ?>">
        <div class="inner">
            <strong><?php echo $gnbName; ?></strong>
            <p><?php echo $gnbDesc; ?></p>
        </div>
    </div>

    <div class="inner sub-wrap">
        <nav class="lnb">
            <h2><?php echo $gnbName; ?></h2>
            <ul>
            <?php if ($gnb == 'about') { ?>
                <li class=""><a href="#">소개</a></li>
                <li class="<?php if ($lnb == '일반현황') echo 'on'; ?>">
                    <a href="history.php">일반현황</a>
                    <ul>
                        <li class=""><a href="#">설립목적</a></li>
                        <li class="<?php if ($lnb2 == '연혁') echo 'on'; ?>"><a href="history.php">연혁</a></li>
                        <li class=""><a href="#">역할</a></li>
                    </ul>
                </li>
                <li class=""><a href="#">주요업무계획</a></li>
                <li class=""><a href="#">조직 및 구성</a></li>
                <li class="<?php if ($lnb == '전화번호') echo 'on'; ?>"><a href="phone.php">전화번호</a></li>
            <?php } else if ($gnb == 'nih') { ?>
                <li class="<?php if ($lnb == '전통 공연·예술') echo 'on'; ?>"><a href="nih.php?bcode=%EC%A0%84%ED%86%B5+%EA%B3%B5%EC%97%B0%C2%B7%EC%98%88%EC%88%A0">전통 공연·예술</a></li>
                <li class="<?php if ($lnb == '전통기술') echo 'on'; ?>"><a href="nih.php?bcode=%EC%A0%84%ED%86%B5%EA%B8%B0%EC%88%A0">전통기술</a></li>
                <li class="<?php if ($lnb == '전통지식') echo 'on'; ?>"><a href="nih.php?bcode=%EC%A0%84%ED%86%B5%EC%A7%80%EC%8B%9D">전통지식</a></li>
                <li class="<?php if ($lnb == '구전 전통 및 표현') echo 'on'; ?>"><a href="nih.php?bcode=%EA%B5%AC%EC%A0%84+%EC%A0%84%ED%86%B5+%EB%B0%8F+%ED%91%9C%ED%98%84">구전 전통 및 표현</a></li>
                <li class="<?php if ($lnb == '전통 생활관습') echo 'on'; ?>"><a href="nih.php?bcode=%EC%A0%84%ED%86%B5+%EC%83%9D%ED%99%9C%EA%B4%80%EC%8A%B5">전통 생활관습</a></li>
                <li class="<?php if ($lnb == '의례·의식') echo 'on'; ?>"><a href="nih.php?bcode=%EC%9D%98%EB%A1%80%C2%B7%EC%9D%98%EC%8B%9D">의례·의식</a></li>
                <li class="<?php if ($lnb == '전통 놀이·무예') echo 'on'; ?>"><a href="nih.php?bcode=%EC%A0%84%ED%86%B5+%EB%86%80%EC%9D%B4%C2%B7%EB%AC%B4%EC%98%88">전통 놀이·무예</a></li>
                <li class="<?php if ($lnb == '전체 현황') echo 'on'; ?>"><a href="nih.php">전체 현황</a></li>
            <?php } else if ($gnb == 'show') { ?>
                <li class="on">
                    <a href="show_month.php">공연</a>
                    <ul>
                        <li class="<?php if ($lnb2 == '월간 공연 일정') echo 'on'; ?>"><a href="show_month.php">월간 공연 일정</a></li>
                        <li class="<?php if ($lnb2 == '연간 공연 일정') echo 'on'; ?>"><a href="show_year.php">연간 공연 일정</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#">전시</a>
                    <ul>
                        <li class=""><a href="#">관람 안내</a></li>
                        <li class=""><a href="#">전시실</a></li>
                        <li class=""><a href="#">디지털 체험관</a></li>
                        <li class=""><a href="#">기획 전시실</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#">교육</a>
                    <ul>
                        <li class=""><a href="#">전문 교육</a></li>
                        <li class=""><a href="#">사회 교육</a></li>
                        <li class=""><a href="#">연간 교육일정</a></li>
                    </ul>
                </li>
            <?php } else if ($gnb == 'open') { ?>
                <li class="<?php if ($lnb == '무형문화재 현황 조회') echo 'on'; ?>"><a href="open_nih.php">무형문화재 현황 조회</a></li>
                <li class="<?php if ($lnb == '공연 일정 조회') echo 'on'; ?>"><a href="open_show.php">공연 일정 조회</a></li>
            <?php } ?>
            </ul>
        </nav>

        <main class="content">
            <div class="content-head">
                <h2><?php echo $pageTitle; ?></h2>
                <ol class="location">
                    <li><a href="index.php"><img src="images/home.svg" alt="홈" title="홈"></a></li>
                    <li><?php echo $gnbName; ?></li>
                    <?php if ($lnb != '') { ?><li><?php echo $lnb; ?></li><?php } ?>
                    <?php if ($lnb2 != '') { ?><li><?php echo $lnb2; ?></li><?php } ?>
                    <?php if ($crumb != '') { ?><li><?php echo $crumb; ?></li><?php } ?>
                </ol>
            </div>
<?php } ?>
