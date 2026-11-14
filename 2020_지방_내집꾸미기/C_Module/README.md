# C 모듈 — 화면에서 시작해 PHP 기능을 직접 붙이는 중

처음에는 **PHP 기능 코드 없이 화면(HTML)만** 있던 폴더이고, 여기에 기능을 하나씩 직접 만들어 붙이고 있다.

- 완료: 로그인 · 회원가입(아이디 중복) · 로그아웃 (`login.php`, `join.php`, `logout.php`), 온라인 집들이 목록 · 글쓰기 · 평점 (`housewarming.php`)
- 아직: 자동입력방지 문자, 전문가 · 시공 후기 (`specialist.php`), 시공 견적 (`estimate.php`)
- DB: `schema.sql` 을 가져오면 `c_module` 데이터베이스와 전문가 4명이 만들어진다. 연결은 `db.php`.

아래는 화면만 있던 때의 설명이다. 아직 기능을 붙이지 않은 페이지에는 그대로 해당한다.

## 이 화면은 어디서 왔나

풀이를 실행해서 나온 화면을 그대로 저장했다. 화면에 보이는 회원 · 글 · 평점 · 후기 · 견적은 모두 **예시 데이터**다
(`../캡처/README.md` 의 "C 시연 데이터" 와 같은 구성).

- 링크와 폼 주소는 풀이와 같은 이름의 상대 경로다: `housewarming`, `login`, `join`, `logout`
  (`login.php`, `join.php`, `logout.php` 는 없으니 누르면 404 가 난다. 만들어야 할 파일이다)
- 자동입력방지 문자 그림은 `/images/captcha.png` 한 장으로 바꿨다 (원래는 `captcha.php` 가 그때그때 그린다)
- `.htaccess` 는 풀이 그대로다. `/housewarming` 을 `housewarming.php` 로 연결한다

## 파일

| 파일 | 화면 | 로그인 상태 | 주소 |
|---|---|---|---|
| `index.php` | 메인 (A 디자인) + 로그인 · 회원가입 모달 | 비회원 | `/` |
| `store.php` | 스토어 (B 화면) | 비회원 | `/store` |
| `housewarming.php` | 온라인 집들이 목록 + 글쓰기 · 평점 주기 모달 | 회원 김하늘(kim) | `/housewarming` |
| `specialist.php` | 전문가 리스트 · 시공 후기 + 후기 작성 모달 | 회원 김하늘(kim) | `/specialist` |
| `estimate.php` | 시공 견적: 요청 리스트 + 견적 요청 · 견적 보기 모달 | 회원 김하늘(kim) | `/estimate` |
| `estimate_specialist.php` | **참고용.** 전문가로 로그인했을 때의 시공 견적 화면 (견적 보내기, 보낸 견적 리스트) | 전문가1(specialist1) | `/estimate_specialist.php` |

`estimate_specialist.php` 는 풀이에 없는 파일이다. 풀이에서는 `estimate.php` 하나가 로그인한 사람이 회원인지 전문가인지에 따라 두 화면을 그린다.

모달은 `js/script.js` 가 연다 (`data-open="#모달아이디"`).

## 폴더

| 폴더 | 내용 |
|---|---|
| `css/` | `style.css` (A + B + C 스타일) |
| `js/` | `script.js` (모달), `store.js` (스토어, B 와 같음) |
| `images/` | 로고, 비주얼, 집들이 · 전문가 사진, `store/` 상품 사진, `captcha.png` |
| `data/` | `store.json` (스토어 상품) |
| `uploads/` | 예시 회원 사진(kim · lee · park · choi.png)과 예시 집들이 사진. 원래는 PHP 가 올린 파일을 저장하는 곳 |

## 보는 법

경로는 모두 상대 경로다 (`css/style.css`, `images/logo.png`, 링크 `housewarming` …).
그래서 htdocs 바로 아래가 아니라 하위 폴더에 둔 채로도 열린다.

1. XAMPP 에서 Apache 를 켠다. (MySQL 은 아직 필요 없다)
2. `http://localhost/2020지방_내집꾸미기/C_Module/` 을 연다.

`.php` 를 뺀 주소(`housewarming` 등)는 `.htaccess` 가 처리하므로 mod_rewrite 와 `AllowOverride All` 이 켜져 있어야 한다 (XAMPP 기본값).

풀이에 있던 `login.php` `join.php` `logout.php` `captcha.php` `setup.php` `inc/` 는 넣지 않았다.
