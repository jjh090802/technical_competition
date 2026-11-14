# 2020 지방기능경기대회 웹디자인 및 개발 · 내집꾸미기

2020년 지방대회 단일과제 「내집꾸미기」의 풀이다. A 모듈은 HTML5 와 CSS3 만으로(자바스크립트 없음), B 모듈은 바닐라 자바스크립트로, C 모듈은 순수 PHP + PDO + MySQL 로 만들고 있다 (진행 중, 아래 [C 모듈 진행 상황](#c-모듈-진행-상황)).
프레임워크와 라이브러리(jQuery, Bootstrap 포함)는 쓰지 않았고, 인터넷 없이 동작한다.

## 실행 방법

### A 모듈 (메인페이지 디자인·퍼블리싱)

`A_Module/Publishing/index.html` 을 크롬으로 연다(더블클릭). 창 폭을 480px 로 줄이면 모바일 배치가 된다.
디자인 시안은 `A_Module/Design/` 의 `main_1600.png`, `main_480.png`, `logo.png` 이다.

### B 모듈 (스토어)

`store/store.json` 을 `fetch` 로 읽는다. 크롬은 더블클릭으로 연 페이지(file://)의 fetch 를 막으므로 웹 서버로 연다.
과제지도 "서버 환경에서만 구동되는 JavaScript 요소(AJAX 등)를 포함한 경우 XAMPP 폴더 전체를 압축하여 제출" 하라고 한다.

1. `C:\xampp\htdocs` 에 있던 파일을 다른 곳으로 옮기고, `B_Module` 의 **내용물**을 넣는다.
2. XAMPP Control Panel 에서 **Apache** 를 Start 한다.
3. `http://localhost/` 를 연다.

### C 모듈 (사이트)

1. `C:\xampp\htdocs` 에 있던 파일을 다른 곳으로 옮기고, `C_Module` 의 **내용물**을 넣는다. 링크가 `housewarming` 처럼 `.php` 없는 주소라서 `.htaccess`(mod_rewrite)가 필요하다.
2. XAMPP Control Panel 에서 **Apache** 와 **MySQL** 을 Start 한다.
3. phpMyAdmin 에서 `C_Module/schema.sql` 을 가져오거나 `mysql -uroot < schema.sql` 을 실행한다. 데이터베이스 `c_module`, 테이블 6개, 전문가 4명(specialist1~4 / 1234)이 만들어진다.
4. `http://localhost/` 에서 시작한다.

MySQL root 에 비밀번호를 걸어 두었다면 `C_Module/db.php` 의 세 번째 인자 `""` 에 넣는다.

## 주소 (C 모듈)

| 주소 | 파일 | 화면 |
|---|---|---|
| `/` | `index.php` | 메인 (A 디자인, 링크만 실제 주소) |
| `/housewarming` | `housewarming.php` | 온라인 집들이 (회원·전문가만) |
| `/store` | `store.php` | 스토어 (B 화면, 누구나) |
| `/specialist` | `specialist.php` | 전문가 (회원·전문가만) |
| `/estimate` | `estimate.php` | 시공 견적 (회원·전문가만) |
| `/login`, `/join`, `/logout` | `login.php`, `join.php`, `logout.php` | 헤더 모달의 폼이 보내는 곳 |

## 폴더 구조

```text
2020지방_내집꾸미기/
├── README.md
├── 선수제공파일_샘플/   과제지의 선수제공파일을 흉내 내어 직접 만든 것 (7절)
├── A_Module/
│   ├── Design/          main_1600.png, main_480.png, logo.png, sources/(비어 있음)
│   └── Publishing/      index.html, css/style.css, images/
├── B_Module/            index.html, css/style.css, js/script.js, images/, store/(store.json + 상품 사진)
├── C_Module/            htdocs 에 넣는 사이트 (아래)
└── 캡처/                실행 화면 43장 + README.md(화면 목록) + index.html(갤러리)
```

```text
C_Module/
├── .htaccess                주소 규칙 (위 표)
├── schema.sql               DB · 테이블 · 전문가 4명
├── db.php                   PDO 연결
├── index.php                메인 + 로그인·회원가입 모달
├── login.php / join.php / logout.php
├── housewarming.php         온라인 집들이: 목록, 글쓰기, 평점 주기
├── specialist.php           전문가 (화면만)
├── estimate.php             시공 견적 (화면만)
├── estimate_specialist.php  참고용: 전문가로 로그인했을 때의 견적 화면 (정적)
├── store.php                스토어 (B 모듈 화면)
├── css/style.css            A + B + C 의 스타일을 한 파일에
├── js/script.js             모달 열기·닫기 (data-open)
├── js/store.js              B 의 js/script.js 와 같다 (자료 경로만 다름)
├── data/store.json          스토어 상품
├── images/                  로고, 비주얼, 집들이, 전문가 사진, store/(상품 사진), captcha.png
└── uploads/                 회원 사진, 집들이 사진이 저장되는 곳 (예시 사진 포함)
```

## 데이터베이스

`C_Module/schema.sql`

```text
users (회원·전문가)          idx, userid UNIQUE, password, name, photo, type(user / specialist)
 ├─< housewarming            idx, user_idx, before_img, after_img, knowhow, created_at
 │    └─< housewarming_rating  post_idx + user_idx UNIQUE → 한 회원이 한 글에 한 번
 ├─< review (시공 후기)       idx, specialist_idx, writer_idx, cost, content, score, created_at
 └─< estimate_request        idx, user_idx, work_date, content, selected_idx(선택한 견적), created_at
      └─< estimate           idx, request_idx, specialist_idx, cost   요청마다 전문가 한 번 (UNIQUE)
```

- 회원과 전문가를 한 표에 두었다. 그래서 가입할 때 아이디 중복 검사가 전문가 아이디까지 저절로 된다.
- 요청의 상태 칸은 따로 두지 않았다. `selected_idx` 가 비어 있으면 진행 중, 들어 있으면 완료다.

## 요구사항 → 코드 위치 (채점기준표 번호)

### A 모듈 (A_Module/Publishing)

| 번호 | 요구사항 | 구현 |
|---|---|---|
| 11 | 비주얼, 집들이, 전문가, 시공 후기 영역 | `index.html` 의 `.visual`, `.house`, `.expert`, `.review` |
| 12, 13 | 헤더, 심벌로고 | `images/logo.png`: 집 안의 소파와 펜던트 조명 심벌 + '내집꾸미기' 글자 (직접 그림) |
| 14 | 메뉴 5개 | `ul.gnb` |
| 15 | 2초마다 1→2→3→2→1… | `@keyframes slide`: 8초에 한 바퀴, 장면마다 1.6초 멈추고 0.4초 이동 |
| 16 | 이전·다음 아이콘 | 라디오 4개(`#s1`~`#s4` = 장면 1, 2, 3, 돌아오는 2)와 `label`. 장면마다 아이콘 한 쌍(`.a1`~`.a4`)을 두고 `@keyframes arrow` 로 지금 장면의 한 쌍만 보이게 했다 |
| 17, 18 | 집들이, Before → After | `.photo .after` 의 `clip-path` 를 `:hover` 때 `inset(0)` 으로 바꿔 0.9초 동안 왼쪽부터 드러낸다. 흰 경계선이 함께 지나간다 |
| 19 | 전문가 3D 카드 | `.card` 의 `perspective` + `.card-in` 의 `rotateY(180deg)` + `backface-visibility` |
| 20, 21 | 시공 후기, 푸터 | `.review-list`, `footer` (footer.txt 문구) |
| 22 | 480px | `@media (max-width: 800px)`. `.gnb` 를 숨기고 `.menu:hover .gnb` 로 펼친다 |

### B 모듈 (B_Module/js/script.js)

| 번호 | 요구사항 | 구현 |
|---|---|---|
| 8, 10, 11 | 검색 칸, 상품 리스트, 드롭 영역, 장바구니 | `index.html`, `renderList()` |
| 9 | store.json 사용 | `load()` 의 `fetch('store/store.json')` |
| 12, 16, 17 | 드래그앤드롭, 제자리로, 이미 담긴 상품 | `dragstart` / `dragover` / `drop` / `dragend`. 담기지 않으면 상품에 `back` 애니메이션 |
| 13~15, 18 | 장바구니, 수량, 삭제, 합계 | `renderCart()`. `input` 이벤트에서 바로 다시 계산하고 `change` 에서 1 미만을 바로잡는다 |
| 19~21 | 구매 모달, 구매 내역 이미지 | `<dialog>` + `showModal()`. `receipt()` 가 canvas 에 그려 `toDataURL()` 을 `<img>` 로 보여 준다 (우클릭 저장) |
| 22~25 | 검색, 하이라이트, 초성, 결과 없음 | `find()` 가 글자 그대로 또는 초성(`cho()`)으로 비교하고, `mark()` 가 `<mark>` 로 감싼다. 없으면 `#empty` |

### C 모듈 진행 상황

| 번호 | 요구사항 | 상태 |
|---|---|---|
| 4, 6 | 회원가입 모달, 아이디 중복 (전문가 포함) | 완료 — `join.php` |
| 5 | 자동입력방지 문자 | 아직 (화면은 `images/captcha.png` 고정 그림) |
| 7~11 | 로그인, 실패 메시지, '이름(아이디)', 로그아웃 | 완료 — `login.php`, `logout.php` |
| 13~18 | 온라인 집들이: 목록, 글쓰기, 평점 | 완료 — `housewarming.php` |
| 19~24 | 전문가: 리스트, 시공 후기 | 아직 (화면만) |
| 25~34 | 시공 견적: 요청, 보내기, 선택 | 아직 (화면만) |

비밀번호는 지금 평문으로 저장·비교한다. 연습용이라 단순하게 두었고, 나중에 `password_hash` / `password_verify` 로 바꿀 예정이다.

## 과제지에 없어서 정한 것

- 슬라이드 아이콘을 누르면 자동 넘김이 멈추고 고른 장면에 머문다. 자바스크립트 없이는 애니메이션이 어디까지 갔는지 이어받을 수 없어서다. 아이콘으로 넘겨도 1→2→3→2 순서를 지킨다.
- 자동 재생 중에 아이콘을 처음 누를 때는 바로 그 장면으로 바뀌고, 그다음부터는 0.6초 동안 미끄러지며 넘어간다.
- 모바일 배치는 화면 폭 800px 이하에서 쓴다 (480px 포함).
- effect.mp4 가 없어서 Before → After 는 왼쪽에서 오른쪽으로 쓸어 넘기는 효과로, 전문가 3D 효과는 Y축으로 뒤집는 카드로 정했다.
- 집들이 글쓰기, 평점 주기, 견적 요청은 회원과 전문가 모두 할 수 있다. 자기 글에는 평점을 줄 수 없고, 전문가는 자기에게 후기를 쓸 수 없고, 자기 요청에는 견적을 보낼 수 없다.
- (만들 예정) 견적을 선택하면 요청이 완료되고, 다시 선택할 수 없다. 견적 보기 모달은 내 요청마다 하나씩 그린다.
- 로그인하면 홈으로 간다. 회원 사진은 헤더의 이름 옆에 작게 보인다.
- C 의 메인(index.php)은 A 의 내용을 그대로 두고, 더보기와 버튼만 실제 페이지로 연결했다.
- store.json 의 가격은 "129,000" 처럼 글자로 넣었다. 코드는 쉼표를 지우고 숫자로 바꾸므로 숫자로 된 json 도 그대로 읽는다.
- C 에서는 주소 `/store` 가 `store.php` 이므로, 스토어 자료를 `store/` 폴더 대신 `data/store.json` 과 `images/store/` 에 두었다.
- 장바구니가 비었을 때 구매하기를 누르면 '장바구니에 상품을 담아 주세요.' 를 보여 준다.

## 직접 만든 샘플 리소스 / 만들지 않은 것

선수제공파일이 없어서 `선수제공파일_샘플/` 에 직접 만들었다. 사진은 모두 Python PIL 로 그린 일러스트다.
실제 대회 파일을 같은 이름으로 넣으면 코드는 그대로 쓸 수 있다 (store.json 은 키 이름이 같아야 한다).

| 파일 | 내용 |
|---|---|
| `visual/visual1~3.jpg` | 1600×640 거실, 침실, 주방 |
| `housewarming_party/before1~4.jpg`, `after1~4.jpg` | 600×450, 같은 방의 Before 와 After 4쌍 |
| `housewarming_party/housewarming_party.txt` | 글마다 사진 이름, 작성자 아이디, 평점, 노하우 |
| `specialist/specialist1~4.jpg`, `specialist.txt` | 400×500 초상, 이름(전문가1~4)·아이디(specialist1~4)·분야 |
| `review/review.txt` | 시공 후기 3개 |
| `footer/footer.txt` | 카피라이트 한 줄 |
| `store/store.json`, `store/1~14.jpg` | 상품 14개 (`id`, `photo`, `product_name`, `brand`, `price`). 초성 검색 예시 'ㅇㄷ → 우디크' 를 위해 브랜드 '우디크' 상품 3개 |

만들지 않은 것

- effect.mp4 두 개: 영상은 만들 수 없어서 효과를 직접 정했다 (위).
- `A_Module/Design/sources/` 의 psd, ai 원본: 포토샵·일러스트레이터 원본은 만들 수 없어 폴더만 비워 두었다. `main_1600.png`, `main_480.png` 는 완성한 페이지를 크롬으로 찍은 것이고, `logo.png` 는 PIL 로 그린 로고를 크게 저장한 것이다.

## 확인한 방법 (A · B)

- 모든 PHP 파일 `php -l`, 모든 JS 파일 `node --check` 통과. A 에 `<script` 와 `on...=` 속성이 없다.
- A: 검사 36개 통과. HTML 태그 짝과 id, 모든 img 의 alt·title, 모든 링크 #, 한글 주석, 채점 11~22. 이 환경의 헤드리스 크롬은 애니메이션 시간이 흐르지 않아서, 검사용 사본에서 Web Animations API 로 시간을 1, 3, 5 … 17초에 맞춰 장면과 아이콘을 확인했다. 이전·다음은 실제 label 을 눌렀다.
- A 실시간: 크롬 DevTools 프로토콜로 진짜 크롬을 움직여 검사 13개 통과. 1, 3, 5, 7, 9, 11초에 1→2→3→2→1→2, 진짜 마우스 클릭과 마우스 오버, 480px 메뉴.
- 1600px, 480px 화면을 캡처해 직접 봤다. 크롬 창은 500px 보다 좁아지지 않아서 480px 은 iframe 과 DevTools 화면 크기 설정으로 찍었다.
- B: 검사 30개 통과. php -S 로 띄우고, 검사 스크립트가 실제 DragEvent 를 만들어 드래그앤드롭 처리기를 그대로 거치게 했다. 합계, 수량, 삭제, 검색(초성 포함), 하이라이트, 구매 모달, 구매 내역 PNG 를 확인했다.
- 실행 화면 43장(A 10, B 12, C 21)을 `캡처/` 에 두었다. C 캡처는 완성했을 때의 목표 화면이다.
- 확인하지 못한 것: W3C 검사기, 사람이 손으로 하는 드래그(OS 의 끌기 그림)는 이벤트로만 확인했다.
