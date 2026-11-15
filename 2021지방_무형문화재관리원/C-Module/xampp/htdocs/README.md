# C 모듈 — 화면만 (PHP 기능 코드 없음)

C 모듈 풀이에서 **PHP 기능 코드를 모두 빼고 화면만** 남긴 폴더다.
파일 이름은 풀이와 같은 `.php` 지만, 안에는 PHP 코드가 한 줄도 없고 HTML 만 들어 있다.
DB 설치, 무형문화재 현황 목록 · 페이징, 무형문화재 등록 · 수정 · 삭제, 그림 보내기, 월간 · 연간 공연 일정, 공연 등록 · 수정 · 삭제, 공개 데이터(openAPI) 같은 기능은 직접 만들어 보는 연습용이다.

## 이 화면은 어디서 왔나

풀이를 실행해서 나온 화면을 2026-11-14 에 그대로 저장했다. 화면에 보이는 무형문화재 · 공연은 모두 **예시 데이터**다
(`../../../캡처/README.md` 의 "C-Module" 과 같은 구성).

- setup.php 가 넣은 기초 데이터: 무형문화재 36건(그림 32건), 샘플 공연 17건
- 앱 폼으로 넣은 것: 무형문화재 '봉산탈춤'(37번째, 그림 있음), 공연 '가을 탈춤 한마당'(18번, 2026-11-20 16:30, 등록한 뒤 한 번 고쳐 수정일이 있다)
- 이 과제에는 로그인 · 역할 구분이 없어서 모든 화면이 누구나 보는 화면(비회원)이다.
- 오늘 칸, d-day, 이번 달 · 올해는 저장한 날(2026-11-14) 기준이다. 날짜가 지나도 화면은 바뀌지 않는다.

주소와 폼은 풀이 그대로다.

- 링크와 폼 주소는 풀이와 같다: `nih.php?view=list&bcode=&page=2`, `show_month.php?year=2026&month=12`, `nih_form.php?id=1&view=album&bcode=&page=1` 처럼 주소 뒤에 값이 붙어 있다.
  지금은 값과 상관없이 같은 화면 파일이 열린다. 주소의 값을 읽어 알맞은 화면을 그리는 것이 만들어야 할 일이다.
- [등록] [수정] [삭제] 를 눌러도 폼이 같은 화면 파일로 보내질 뿐 저장되지 않는다. 삭제 확인 창(confirm)은 뜬다.
- 앨범의 그림과 수정 화면의 '지금 그림' 은 풀이에서는 `image.php?file=1623117.jpg` 처럼 `image.php` 가 htdocs 밖 `../nihcImage/` 의 그림을 읽어 보낸다 (그림은 직접 경로로 열지 않는다).
  `image.php` 가 없으면 그림이 깨지므로, 화면에 쓰인 그림만 `images/nihcImage/` 에 복사하고 주소를 `images/nihcImage/1623117.jpg` 로 바꿨다.
  `image.php` 를 만들면 주소를 `image.php?file=...` 로 되돌리고 `images/nihcImage/` 는 지운다.
- 공개 데이터 화면의 `openAPI/nihList.php`, `openAPI/showList.php` 링크와 [조회 (새 창)] 은 404 가 난다. 공개 데이터 전문은 만들어야 할 기능이다.
  화면의 요청 주소 `http://127.0.0.1/openAPI/...` 는 풀이가 접속한 서버 이름으로 그린 것이다 (127.0.0.1 로 열었을 때 모습).

## 파일

| 파일 | 화면 | 로그인 상태 | 주소 |
|---|---|---|---|
| `index.php` | 메인 (A 화면 그대로, 메뉴가 C 페이지로 이어짐) | 비회원 (로그인 없음) | `/` |
| `history.php` | 연혁: 연도 탭 · 연혁 자리 + 등록 · 수정 다이얼로그, 삭제 확인 창 (`js/history.js` 가 채운다, B 와 같음) | 비회원 | `/history.php` |
| `phone.php` | 전화번호: 부서 탭 · 연락처 자리 (`js/phone.js` 가 `/restAPI/phone.php` 를 읽어 채운다) | 비회원 | `/phone.php` |
| `nih.php` | 무형문화재 현황 전체 · 앨범형 1쪽 (총 37건 · 1 / 5 페이지, 4번째 '갓일' 은 no image) | 비회원 | `/nih.php` |
| `nih_list.php` | **참고용.** 같은 목록의 목록형 1쪽 (순번 · 문화재명 · 종목 · 지정호수 · 소재지 · 분류, 10개씩 1 / 4 페이지) | 비회원 | `/nih.php?view=list` |
| `nih_form.php` | 무형문화재 수정: '봉산탈춤' 의 모든 값과 지금 그림, [목록] [삭제] [수정] + 삭제 확인 창 | 비회원 | `/nih_form.php?id=37&view=album&bcode=&page=5` |
| `show_month.php` | 월간 공연 일정 2026년 11월 (오늘 칸 강조, 공연마다 d-day, 날짜 칸의 +, 이전 · 다음 달) | 비회원 | `/show_month.php` |
| `show_year.php` | 연간 공연 일정 2026년 (1~12월, 이번 달 강조, d-day, 이전 · 다음 해) | 비회원 | `/show_year.php` |
| `show_form.php` | 공연 수정: '가을 탈춤 한마당' 의 모든 값, 등록일 · 수정일 · 고유번호(d-day), [목록] [삭제] [수정] + 삭제 확인 창 | 비회원 | `/show_form.php?id=18&from=month` |
| `open_nih.php` | 공개 데이터 > 무형문화재 현황 조회: 요청 주소, 요청 · 응답 항목, 예시, 바로 해 보기 | 비회원 | `/open_nih.php` |
| `open_show.php` | 공개 데이터 > 공연 일정 조회: 요청 주소, 요청 · 응답 항목, 예시(이번 달 · 올해), 바로 해 보기 | 비회원 | `/open_show.php` |
| `restAPI/phone.php` | 화면이 아니다. 전화번호 전문(JSON)을 저장한 **고정 사본** (아래 참고) | | `/restAPI/phone.php` |

`nih_list.php` 는 풀이에 없는 파일이다. 풀이에서는 `nih.php` 하나가 `view` 값에 따라 앨범형과 목록형을 그린다.

등록 화면은 따로 저장하지 않았다. 풀이에서는 `nih_form.php` · `show_form.php` 를 `id` 없이 열면 등록 화면을 그린다. 수정 화면과 같은 폼이고 다음만 다르다.

- 제목과 현재 위치가 '무형문화재 등록' · '공연 등록' 이다. 버튼은 [목록] [등록] 뿐이고 삭제 폼도 없다.
- 칸은 비어 있고 처음 값만 들어 있다.
  무형문화재: 종목코드 17, 문화재종목 국가무형문화재, 문화재분류 무형문화재, 분류는 보던 분류, 지정해제여부 N, 경도 · 위도 0.
  공연: 공연일은 달력에서 누른 날(없으면 오늘), 공연시간 14:00, 주관 무형문화재관리원.
- 무형문화재 등록에는 지금 그림이 없고, 그림 칸 안내가 'jpg, png, gif 파일 · xampp\nihcImage 폴더에 저장됩니다.' 만 나온다.
- 공연 등록에는 등록일 · 수정일 · 공연 고유번호 칸이 없다.

## 직접 만들 파일 (넣지 않은 파일)

| 파일 | 하는 일 |
|---|---|
| `setup.php` | DB `nihc2021`, 테이블 2개, `data/` 의 xml 로 기초 데이터, 샘플 공연 |
| `inc/db.php` | DB 연결과 공통 값 · 함수 |
| `inc/header.php`, `inc/footer.php` | 모든 화면의 머리(헤더 · 메뉴 · 서브 비주얼 · 서브 메뉴 · 현재 위치)와 꼬리(푸터) |
| `image.php` | htdocs 밖 `nihcImage` 의 그림을 읽어 보낸다 |
| `openAPI/nihList.php` | 무형문화재 현황 조회 전문 (JSON, 그림은 base64) |
| `openAPI/showList.php` | 공연 일정 조회 전문 (JSON, 월별 M · 년도별 Y) |

화면 파일(위 표의 `.php`)도 지금은 HTML 뿐이라, DB 에서 읽어 그리는 부분은 직접 PHP 로 바꿔야 한다.

## 고정 사본: restAPI/phone.php

`restAPI/phone.php` 는 풀이의 파일 대신 그 응답(JSON)을 그대로 저장한 파일이다. PHP 코드가 없어서 늘 정상 전문(statusCd 200, 12개 부서 47명)만 돌려준다. `?error=1` 오류 시험은 되지 않는다.

이 전문은 원래 선수제공파일이다: `../../../선수제공파일_샘플/B-Module/restAPI/phone.php` (B-Module 의 `restAPI/phone.php` 와 같다).
풀이의 C 사본은 설명 주석을 더해 선수제공파일과 바이트가 달라서, 응답만 저장했다. 오류 시험이 필요하면 선수제공파일을 이 자리에 복사해 넣는다.

## 폴더

스타일은 `style.css` 한 파일이다 (A + B + C 스타일).

| 폴더 | 내용 |
|---|---|
| `images/` | 심벌로고, 비주얼, 팝업, 행사, 배너, 유네스코, 연혁 그림, 홈 아이콘 |
| `images/nihcImage/` | 화면에 보이는 무형문화재 그림 사본 (`image.php` 대신. 위 설명 참고) |
| `js/` | `history.js` (연혁), `phone.js` (전화번호). B 와 같다 |
| `data/` | setup.php 가 읽는 `nihList.xml` 과 `detail/*.xml` (선수제공파일 그대로) |
| `inc/` | `.htaccess` 만 있다 (주소로 열지 못하게 막는다). db.php · header.php · footer.php 는 직접 만든다 |
| `restAPI/` | `phone.php` 고정 사본 |
| `../nihcImage/` (htdocs 밖) | 무형문화재 그림 32장 + 예시로 등록한 봉산탈춤 그림 `6af7e6c850985.jpg` (예시용으로 간단히 그린 그림). 원래는 PHP 가 올린 그림을 저장하는 곳 |

## 보는 법

경로가 `/restAPI/phone.php`, `/` 처럼 `/` 로 시작하는 곳이 있으므로 XAMPP 로 연다.

1. `C:\xampp\htdocs` 에 이 폴더의 **내용물**을 넣는다 (`inc/.htaccess` 포함). `../nihcImage/` 는 `C:\xampp\nihcImage\` 에 넣는다 (image.php 를 만들면 쓴다).
2. XAMPP 에서 Apache 를 켠다. (MySQL 은 아직 필요 없다)
3. `http://127.0.0.1/` 를 연다.

풀이에 있던 `setup.php` `image.php` `inc/db.php` `inc/header.php` `inc/footer.php` `openAPI/` 는 넣지 않았다.
