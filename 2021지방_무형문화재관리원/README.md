# 2021 지방기능경기대회 웹디자인 및 개발 — 무형문화재관리원

2021년 지방대회 단일과제 「무형문화재관리원」을 A·B·C 세 모듈로 모두 만든 풀이다.
A 는 HTML + CSS(자바스크립트 없음), B 는 바닐라 JS(fetch, localStorage), C 는 PHP + PDO + MySQL 이다. 프레임워크와 jQuery 는 쓰지 않았다.

## 실행 방법

### A-Module (디자인 · 퍼블리싱)

1. `A-Module/02.퍼블리싱/index.html`, `sub1.html`, `sub2.html` 을 크롬에서 더블클릭으로 연다.
2. 디자인 시안은 `A-Module/01.디자인시안/` 의 jpg 5장이다. 완성한 페이지를 헤드리스 크롬으로 찍었다.
3. 반응형은 크롬 개발자 도구에서 폭을 480px 로 줄여 본다. 768px 이하에서 모바일 화면으로 바뀐다.

### B-Module (자바스크립트)

1. `B-Module` 폴더의 **내용물**을 `C:\xampp\htdocs\` 바로 아래에 넣는다. 전문 주소가 `/restAPI/phone.php`, `/xml/nihList.xml` 처럼 맨 앞(`/`)부터 시작하기 때문이다.
2. XAMPP 에서 Apache 를 켜고 `http://127.0.0.1/` 를 연다. 메뉴에서 연혁, 전화번호, 무형문화재 현황으로 들어간다.
3. `restAPI/` 와 `xml/` 은 선수제공파일 샘플을 미리 넣어 둔 것이다. 대회에서는 이 두 폴더를 제출하지 않는다.
4. 전화번호 오류 화면은 주소 끝에 `?error=1` 을 붙여 연다 (`http://127.0.0.1/phone.html?error=1`).

연습할 때는 `php -S 127.0.0.1:8000 -t B-Module` 로 띄워도 된다.

### C-Module (PHP + MySQL)

1. `C-Module/xampp/htdocs/` 의 내용물을 `C:\xampp\htdocs\` 에, `C-Module/xampp/nihcImage/` 를 `C:\xampp\nihcImage\` 에 넣는다. 그림 폴더는 htdocs 밖이어야 한다.
2. Apache 와 MySQL 을 켜고 `http://127.0.0.1/setup.php` 를 **한 번** 연다. DB `nihc2021`, 테이블 2개, 무형문화재 36건, 샘플 공연 17건이 만들어진다. 다시 열면 모두 지우고 처음부터 만든다.
3. `http://127.0.0.1/` 에서 시작한다.

MySQL root 에 비밀번호를 걸어 두었다면 `inc/db.php` 와 `setup.php` 의 세 번째 인자 `''` 에 넣는다.

## 폴더 구조

```text
2021지방_무형문화재관리원/
├── README.md
├── A-Module/
│   ├── 01.디자인시안/       logo.jpg, main.jpg, main_480p.jpg, sub1.jpg, sub2.jpg
│   └── 02.퍼블리싱/
│       ├── index.html       메인 (헤더, 비주얼, 새 소식, 팝업 존, 행사, 유네스코, 배너, 푸터)
│       ├── sub1.html        무형문화재 현황 목록 (10.무형문화재현황.txt)
│       ├── sub2.html        월간 공연 일정 달력 (11.월간공연일정.txt)
│       ├── style.css        메인·서브·반응형 스타일 한 파일
│       └── images/          심벌로고 SVG, 비주얼, 팝업, 행사, 배너, 유네스코 그림
├── B-Module/                htdocs 에 넣는 내용
│   ├── index.html, sub2.html   A 페이지 (메뉴 링크만 B 페이지로)
│   ├── history.html         연혁 (js/history.js)
│   ├── phone.html           전화번호 (js/phone.js)
│   ├── nih.html             무형문화재 현황 앨범 (js/nih.js)
│   ├── style.css            A 스타일 + B 에서 더한 스타일
│   ├── restAPI/phone.php    선수제공파일 샘플 (전화번호 전문)
│   └── xml/                 선수제공파일 샘플 (nihList.xml, detail/, image/)
├── C-Module/xampp/
│   ├── nihcImage/           무형문화재 그림 (htdocs 밖)
│   └── htdocs/
│       ├── setup.php        DB · 테이블 · 기초 데이터 · 샘플 공연 (처음 한 번)
│       ├── index.php        메인 (A 화면)
│       ├── history.php, phone.php   연혁, 전화번호 (B 의 js 그대로)
│       ├── nih.php          무형문화재 현황 (앨범 8개 / 목록 10개, 분류별, 페이징)
│       ├── nih_form.php     무형문화재 등록 · 수정 · 삭제
│       ├── image.php        nihcImage 의 그림을 읽어 보낸다
│       ├── show_month.php   월간 공연 일정 (달력, d-day)
│       ├── show_year.php    연간 공연 일정 (1~12월, d-day)
│       ├── show_form.php    공연 등록 · 수정 · 삭제
│       ├── open_nih.php, open_show.php   공개 데이터 사용 방법
│       ├── openAPI/nihList.php, openAPI/showList.php   JSON 전문
│       ├── restAPI/phone.php   전화번호 전문 (B 에서 그대로)
│       ├── data/            setup.php 가 읽는 무형문화재_현황 xml
│       ├── inc/             db.php(연결·공통 함수), header.php(메뉴), footer.php
│       └── style.css, images/, js/
└── 선수제공파일_샘플/       우리에게 없는 선수제공파일을 직접 만든 것 (아래 7절)
```

## 데이터베이스 (nihc2021)

```text
nih (무형문화재 현황)   id PK, sn(순번), no(고유 키값),
                        구성표 26칸: ccbaKdcd, ccbaAsno, ccbaCtcd, ccbaCpno, longitude, latitude, ccmaName, crltsnoNm,
                        ccbaMnm1, ccbaMnm2, gcodeName, bcodeName, mcodeName, scodeName, ccbaQuan, ccbaAsdt, ccbaCtcdNm,
                        ccsiName, ccbaLcad, ccceName, ccbaPoss, ccbaAdmin, ccbaCncl, ccbaCndt, image(파일 이름), content
                        종목코드 + 시도코드 + 지정번호 는 겹치지 않는다 (UNIQUE). 상세 xml 파일 이름 규칙과 같다.
shows (공연 일정)       showUid PK(자동), showName, showDate, showTime, organizer, place, cast, rm,
                        registDt(등록할 때 자동), updtDt(고칠 때 자동, ON UPDATE CURRENT_TIMESTAMP)
```

두 테이블은 서로 잇지 않는다. 칸 이름을 xml 태그와 똑같이 지어서 setup.php 는 태그 이름 그대로 칸에 넣고, 등록 폼과 openAPI 는 `inc/db.php` 의 `$nihFields` 한 목록을 함께 쓴다.

기초 데이터는 목록 xml 한 항목마다 상세 xml(`{종목코드}_{시도코드}_{지정번호}.xml`)을 열어 목록·상세의 모든 태그를 한 줄로 합쳐 넣는다.

## 요구사항 → 코드 위치 (채점기준표 번호)

### A-Module (객관적 항목)

| 번호 | 요구사항 | 구현 |
|---|---|---|
| 24 | 헤더·비주얼·새 소식·팝업 존·행사·유네스코·배너·푸터로 구분 | `index.html` 의 영역 8개 (주석 `===== 영역 =====`) |
| 25 | 제공 심벌 + '무형문화재관리원' 심벌로고 | `images/logo.svg` (삼태극 북 심벌 + 글자), `01.디자인시안/logo.jpg` |
| 26 | 헤더·푸터 밖 영역마다 제목 | `.title` (비주얼은 장면 제목 + 숨은 `h2`) |
| 27 | 로고, 메뉴, 유틸리티(로그인·회원가입·문의하기), 언어 4개 | `.topbar` 의 `.util`, `.lang` (마우스를 올리면 펼침) |
| 28 | 새 소식 4탭, 최근 게시물 | 라디오 4개 + `#news1:checked ~ .p1` |
| 29 | 행사 8개: 종류·제목·장소·일시 순서대로 | `.event-list` 카드 8개, 종류 색 `.k1`~`.k4`, 상세내용 보기 버튼 |
| 30 | 유네스코 연도별 확인 | 연도 라디오 13개 타임라인 + `.year-panel` |
| 31 | 푸터: 심벌로고(색 바꿈), 저작권, 푸터 메뉴 5개 | `images/logo_white.svg`, `.footer-menu` |
| 32~37, 45~49 | 서브: 헤더·푸터 그대로, 서브 메뉴, 현재 위치, 타이틀, 목록+페이징 / 달력+이전·다음 달 | `sub1.html` `.lnb` `.location` `.board` `.paging` / `sub2.html` `.calendar` `.cal-btn` |
| 38, 39 | 1depth 하이라이트 + 2·3depth 패널이 미끄러져 내려옴, 서브메뉴 하이라이트, 벗어나면 원래대로 | `.gnb > ul > li:hover .sub` (max-height 0 → 360px), `.sub a:hover` |
| 40 | 비주얼 3초마다 1→2→3→1, 전환 효과, 글자도 바뀜 | `@keyframes slide` 9초 주기에 장면마다 음수 지연(-6s, -3s), 겹쳐 사라지기 + 줌, `slideText` |
| 41 | 스크롤해도 헤더 고정 | `.header { position: fixed }` |
| 42, 43 | 480px 에서 모든 영역, 비주얼 효과 | `@media (max-width: 768px)` 한 곳. 햄버거 메뉴는 체크박스 |
| (배너) | 오른쪽→왼쪽, 1초 이동 후 1초 멈춤, 첫 배너가 끝에 이어 붙음 | 배너 8개를 두 번 이어 붙이고 `@keyframes banner` 16초에 6.25% 씩 |

### B-Module

| 번호 | 요구사항 | 구현 |
|---|---|---|
| 7 | 연도 탭, 등록·수정·삭제 버튼, 연혁 내용, 그림 | `history.html` + `js/history.js` 의 `render()` |
| 8, 13 | 등록·수정은 모달 다이얼로그 | `<dialog>` + `showModal()`, 저장은 `form` 의 submit |
| 9, 11 | 저장된 모든 연도가 탭, 누르면 그 연도만 | `render()` 의 `new Set(...연도)`, `filter(startsWith(year))` |
| 10, 12 | 브라우저를 다시 켜도 연혁과 고른 탭 유지 | localStorage `nihc-history`, `nihc-history-year` |
| 14 | 삭제는 확인 창 | 경고 다이얼로그(`#confirmDialog`) 의 [확인] |
| 15~20 | 전화번호: 부서 탭(전체 포함), 부서·이름·번호, 탭 필터 | `js/phone.js` 의 `render()` (전문에 나온 순서대로 부서) |
| 16 | REST 통신 (JSON) | `fetch('/restAPI/phone.php')` → `res.json()` |
| 21, 공통 | statusCd 가 200 이 아니면 콘텐츠 영역에 상태 메시지, 알림 후 메인으로 | `showError()` (메시지 표시 → `alert` → `location.href = '/'`) |
| 22~26 | 앨범 8개, 총 항목 수·현재 페이지·총 페이지, 페이징 | `js/nih.js` 의 `render()`, `renderPaging()` (10쪽 묶음) |
| 23, 27 | 목록 xml → 항목마다 상세 xml 의 imageUrl → `/xml/image/` | `loadList()`, `loadImage()` (DOMParser) |
| 28 | 그림이 없으면 no image | `NO_IMAGE` (흐린 심벌 + no image). imageUrl 이 비었거나, 상세 xml 이 없거나, 파일이 없을 때 |

### C-Module

| 번호 | 요구사항 | 구현 |
|---|---|---|
| 9, 10 | 목록·상세 xml 로 기초 데이터, 그림은 직접 경로가 아님 | `setup.php`, `image.php?file=` (htdocs 밖 `IMG_DIR` 를 읽어 보냄) |
| 11, 12 | 앨범형(문화재명+그림), 목록형(순번·문화재명·종목·지정호수·소재지) | `nih.php` 의 `$view` |
| 13, 14 | 총 개수·현재 페이지·총 페이지, 페이징 (8개 / 10개) | `nih.php` 의 `COUNT(*)`, `LIMIT … OFFSET`, 범위 밖 페이지는 처음·끝으로 |
| 15 | 2depth 메뉴는 그 분류만 | `nih.php?bcode=분류` (`$bcodes` 목록에 있는 값만 받음) |
| 16 | 등록: 구성표 모든 항목, 필수값, 그림은 nihcImage 에 | `nih_form.php` 의 `save` (uniqid 이름, 확장자·getimagesize 검사) |
| 17 | 그림 또는 문화재명 클릭 → 수정, 그림 바꾸기 | `nih_form.php?id=` (새 그림을 고르면 예전 파일 삭제) |
| 18 | 수정 화면의 삭제, 그림도 삭제 | `nih_form.php` 의 `delete` (확인 창) |
| (UX) | 목록으로 돌아갈 때 보기 방식·분류·페이지 유지 | `$keep` (view, bcode, page) 를 폼 주소에 실어 둠 |
| 20~22 | 공연 등록·수정·삭제 | `show_form.php` (등록일·수정일은 DB 가 자동) |
| 23~25 | 월간 달력 1일~말일, d-day, 처음은 이번 달, 이전·다음 달 | `show_month.php` (`mktime` 으로 0월·13월 넘김), `dday()` |
| 26~28 | 연간 1~12월, 처음은 올해, 이전·다음 해, d-day | `show_year.php` |
| (같은 데이터) | 월간·연간이 공연일 기준 같은 데이터 | 두 화면 모두 `showDate BETWEEN ? AND ?` |
| 29~31 | 무형문화재 openAPI: JSON, 그림 base64, pageNo·numOfRows, bcodeName 포함 검색 | `openAPI/nihList.php` (JSON_UNESCAPED_SLASHES 로 data URI 를 그대로 붙여 넣을 수 있게) |
| 32, 33 | 공연 openAPI: 월별(M)·년도별(Y) | `openAPI/showList.php` (잘못된 요청은 400 + error) |
| 2depth | 공개 데이터 사용 방법 화면 | `open_nih.php`, `open_show.php` (주소, 요청·응답 항목, 예시, 바로 해 보기) |

## 과제지에 없어서 정한 것

- **메뉴 표**: 한글 과제지의 표를 칸 그대로 옮겼다. 1depth 는 무형문화재관리원·무형문화재 현황·행사 안내·전승지원·공개 데이터 5개이고, `주요업무계획` 은 일반현황의 3depth 가 아니라 2depth 다.
- **링크**: 과제지는 모든 링크를 `#` 로 하라고 하면서 배너는 "링크 주소와 target 을 올바르게" 하라고 한다. 배너만 07.배너영역.txt 의 주소와 target 을 넣고 나머지는 `#` 로 두었다.
- **반응형 기준**: 768px 이하 한 곳에 모았다. 480px 화면에 맞추어 만들었고 그보다 넓은 휴대폰·태블릿도 같은 화면이다.
- **연혁의 '마지막 년도'**: 탭이 최근 연도부터 놓이고 와이어프레임이 2021년을 고른 모습이라 가장 최근 연도로 정했다.
- **연혁 기본 자료**: 처음 열면 2017~2021년 연혁 15건을 보여 준다. 한 번이라도 저장하면 그 뒤로는 저장한 것만 쓴다 (모두 지우면 빈 화면).
- **연혁 그림**: 와이어프레임의 '이미지' 자리는 연도에 따라 3장 가운데 하나를 보여 준다.
- **상세 xml 의 그림 항목**: B 과제지는 `imageUrl`, C 과제지는 `image` 라고 한다. 샘플 상세 xml 에는 둘 다 같은 파일 이름으로 넣었다. B 는 `imageUrl`, C 의 setup.php 는 `image` 를 쓴다 (`image` 가 비었으면 `imageUrl` 의 파일 이름). DB 에는 `image` 한 칸만 둔다.
- **그림 폴더 이름**: B 과제지는 `/xml/image/`, C 과제지는 `무형문화재_현황\nihcImage` 라고 한다. 샘플은 `nihcImage` 로 만들고, B-Module 에서는 `xml/image/` 로 이름을 바꿔 넣었다.
- **전화번호 오류 시험**: 샘플 phone.php 는 `?error=1` 로 부르거나, 부른 페이지 주소(Referer)에 `error=1` 이 있으면 statusCd 500 을 돌려준다. 페이지 코드에는 시험용 코드를 넣지 않았다.
- **무형문화재 목록 전문의 상태 코드**: xml 에는 상태 코드가 없어서 HTTP 상태(404 등)와 xml 형식 오류를 상태로 보았다. 상세 xml 을 못 받으면 그 항목만 no image 로 둔다.
- **B 의 목록 보기**: 와이어프레임에 앨범·목록 단추가 있어 목록 보기(10개씩)도 넣었다.
- **C 의 순번**: 목록형 순번은 현재 정렬로 매긴 번호(1, 2, 3 …)다. 새로 등록한 항목은 sn·no 를 마지막 번호 다음으로 매긴다.
- **C 의 필수값**: 구성표의 필수 6개(종목코드, 지정번호, 시도코드, 문화재종목, 지정호수, 문화재명)를 검사한다. 분류(bcodeName)는 2depth 메뉴와 맞추려고 7개 가운데 고르게 했다. 종목코드+시도코드+지정번호가 같은 항목은 둘 수 없다.
- **샘플 공연**: setup.php 를 연 날을 기준으로 올해 매달 15일, 이번 달 오늘·3일·24일(2건), 다음 해 1월 10일에 넣는다. 언제 열어도 이번 달 달력과 올해 연간 화면에 공연이 보인다.
- **시간대**: XAMPP 의 PHP 기본 시간대가 유럽이라 `inc/db.php` 에서 `Asia/Seoul` 로 맞췄다 (오늘, d-day).
- **openAPI 잘못된 요청**: 필수값이 없거나 형식이 틀리면 HTTP 400 과 `{"error": "…"}` 를 돌려준다. numOfRows 는 100 까지 받는다.
- **C 의 xml 위치**: B 에서 쓰던 `xml/` 폴더는 지우라는 지시를 따랐다. setup.php 가 읽을 xml 은 `htdocs/data/` 에 두었다.
- **C 의 inc 폴더**: Apache 에서는 `inc/.htaccess` 가 주소로 여는 것을 막는다.

## 직접 만든 샘플 리소스 / 빈 스켈레톤

직접 만든 샘플 (선수제공파일이 없어서)
- `선수제공파일_샘플/A-Module/01~11 txt`: 메뉴, 비주얼 문구 3개, 새 소식 4탭×5건, 팝업 3개, 행사 8개, 유네스코 21건(실제 등재 연도), 배너 8개, 푸터, 기타, 무형문화재현황 10건, 2021년 5월 공연 10건.
- `선수제공파일_샘플/A-Module/이미지자료/`: 비주얼 3장, 배너 8장, 심벌(삼태극을 그린 북). SVG 로 그려 크롬으로 찍었다.
- `선수제공파일_샘플/B-Module/restAPI/phone.php`: 12개 부서 47명 (이름은 지어낸 것).
- `선수제공파일_샘플/무형문화재_현황/`: nihList.xml, detail/*.xml 36개, nihcImage/ 그림 32장. 이름은 실제 국가무형문화재 35건과 시도무형문화재 매사냥 1건을 7개 분류에 나누었다. 지정번호·지정일·관리자·좌표·설명은 검사용으로 지어낸 값이 섞여 있으니 실제 자료로 쓰지 않는다. **원본 자료는 154건**이었고 채점기준도 154건을 본다. 갓일·경기민요·제염·인삼재배와 약용문화 4건은 그림을 비워 no image 를 시험한다.
- A 의 팝업 그림 3장, 행사 그림 8장, 유네스코 그림 21장, 심벌로고 SVG 2개(밝은·어두운 바탕), B 의 연혁 그림 3장.

빈 스켈레톤 (링크만 있고 화면이 없는 메뉴)
- 과제가 요구하지 않은 메뉴(소개, 설립목적, 역할, 주요업무계획, 조직 및 구성, 전시·교육 하위, 전승지원 하위)는 `#` 링크로만 두었다.
- 유틸리티 메뉴(로그인, 회원가입, 문의하기)와 언어 선택도 `#` 링크다.
- 디자인 시안의 psd·ai 원본은 만들 수 없어서 만들지 않았다. jpg 는 완성 페이지를 찍은 것이다.

## 확인한 방법

검사 스크립트는 모두 작업 폴더(`scratchpad/work-2021/`)에 있고 결과물에는 넣지 않았다.

- **A (27개 통과)**: `test_a.py`. 세 페이지에 `<script` 와 on… 속성 없음, img 54+3+3개 모두 alt·title, 링크는 `#` 와 배너 주소뿐, id 중복·label 짝·태그 짝, 한글 주석, HTML Tidy 5.8(HTML5) 오류·경고 0, CSS 중괄호 짝, 애니메이션 길이, 그림 47개 존재, 시안 5장. 비주얼·팝업·배너 애니메이션은 페이지 사본에서 Web Animations API 로 시각을 멈춰 1→2→3→1 순서와 3초 간격, 배너 1초 이동·1초 멈춤을 숫자로 확인했다. 1920·480 화면, 메뉴가 열린 모습(마우스 상태는 CSS 로 강제), 모바일 메뉴를 헤드리스 크롬으로 찍어 직접 보았다.
- **B (32개 통과)**: `test_b.py`. B-Module 사본을 `php -S` 로 띄우고 페이지에 탐침 스크립트를 붙여 헤드리스 크롬으로 실행했다. 연혁 등록·수정·빈 값·삭제(취소/확인)·탭, 같은 프로필로 크롬을 다시 띄워 연혁과 고른 탭이 남는지, 전화번호 전문과 화면 비교·부서 필터, 오류 전문일 때 상태 메시지 → 알림 → 메인 이동, 앨범 개수·페이지·페이징·그림 7장 실제 로드·no image, 목록 전문 404 와 상세 전문 404 처리.
- **C (50개 통과)**: `test_c.py`. C-Module 의 xampp 구조째 사본을 만들어(nihcImage 가 htdocs 밖) DB 주소만 3307 로 바꾸고 `php -S 127.0.0.1:8821` 로 띄웠다. setup 두 번, xml 의 모든 항목이 DB 와 같은지, image.php 가 원본과 같은 바이트를 보내는지, 앨범·목록 개수와 페이징, 7개 분류, 등록(필수값·그림 아닌 파일·중복 거절)·수정(그림 교체 시 예전 파일 삭제)·삭제(그림 파일 삭제), 공연 등록·수정·삭제와 등록일·수정일, 달력의 날짜 칸·d-day·이전/다음 달(1월·13월), 연간 12달과 월간 12달이 같은 공연인지, openAPI 두 개의 응답 구조·base64 그림 복원·페이지 계산·포함 검색·400 오류.
- **HTML 검사**: A·B 의 모든 html 과 C 가 내보낸 화면 14개를 HTML Tidy 로 검사해 오류·경고 0.
- **PHP·JS**: 모든 PHP 파일 `php -l`, 모든 JS 파일 `node --check` 통과.
- **화면 캡처**: `캡처/` 폴더에 모듈별 화면과 openAPI 응답을 모았다 (`캡처/README.md`, `캡처/index.html`).

확인하지 못한 것
- 실제 Windows XAMPP(Apache + MariaDB)에서는 돌려 보지 않았다. PHP 8.5 내장 서버와 MySQL 8 로 확인했다. `inc/.htaccess` 는 Apache 에서만 동작한다.
- W3C 온라인 검사기는 인터넷이 없어 쓰지 못했고 HTML Tidy 로 대신했다.
- 마우스를 올린 상태는 실제 마우스로 보지 못하고 같은 스타일을 CSS 로 강제해 찍었다.
