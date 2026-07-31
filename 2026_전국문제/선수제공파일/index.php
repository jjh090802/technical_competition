<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pat Care | 믿고 맡기는 반려 돌봄 플렛폼</title>
</head>
<body>

    <input type="checkbox" hidden id="join_box_del">
    <input type="checkbox" hidden id="login_box_del">

    <header>
        <div class="logo_img_box">
            <a href="../선수제공파일/index.html"><img src="logo.png" alt="logo_img" title="로고사진" width="250px"></a>
        </div>

        <nav>
            <div class="site_reader">
                <a href="#">사이트 소개</a>

                <div id="submenu">
                    <li class="hight"><a href="#">서비스 소개</a></li>
                    <li class="low"><a href="#">회사 소개</a></li>
                </div>
            </div>

            <div class="patceater">
                <a href="#">펫시터</a>

                <ul id="submenu">
                    <li class="hight"><a href="#">전체 펫시터</a></li>
                    <li class="middle"><a href="#">인기 펫시터</a></li>
                    <li class="low"><a href="#">펫시터 지원</a></li>
                </ul>
            </div>

            <div class="dolebom">
                <a href="#">돌봄</a>
            
                <ul id="submenu">
                    <li class="hight"><a href="#">예약하기</a></li>
                    <li class="low"><a href="#">돌봄 서비스 안내</a></li>
                </ul>
            </div>

            <div class="dolebom">
                <a href="#">회원 서비스</a>

                <ul id="submenu">
                    <li class="hight"><a href="#">마이페이지</a></li>
                    <li class="low"><a href="#">회원가입</a></li>
                </ul>
            </div>
            
            <div class="dolebom">
                <a href="#">관리자</a>
            
                <ul id="submenu">
                    <li class="hight"><a href="#">펫시터 지원 관리</a></li>
                    <li class="middle"><a href="#">예약 / 신청 내역</a></li>
                    <li class="low"><a href="#">회원 관리</a></li>
                </ul>
            </div>
        </nav>

        <div class="login_box">
            <label for="login_box_del">
                <span class="login">로그인</span>
            </label>
            
            <label for="join_box_del">
                <span class="join">회원가입</span>
            </label>
        </div>

    </header>

    
    <div class="login_SubBox">
        <div class="login_move_box">
            <label for="login_box_del">
                <span>X</span>
            </label>
            <h2>로그인</h2>
            <form action="register_process.php" method="post">
                <input required name="user_id" type="text" placeholder="아이디"><br>
                <input required name="password" type="password" placeholder="비밀번호">

                <div class="button_center">
                    <button type="submit">로그인</button>
                    <span>아직 회원이 아니신가요?<a href="#">회원가입하러가기</a></span>
                </div>
            </form>
        </div>
    </div>

    <div class="join_SubBox">
        <div class="join_move_box">
            <label for="join_box_del">
                <span>X</span>
            </label>
            <h2>회원가입</h2>
            <form action="register_process.php" method="post" >
                <input required name="user_id" type="text" placeholder="아이디"><br>
                <input required name="password" type="password" placeholder="비밀번호">
            
                <div class="button_center">
                    <button type="submit">회원가입</button>
                </div>
            </form>
        </div>
    </div>

    <main>

        <div class="set">
            <div class="img_move">
                <img src="../선수제공파일/B-Module/images/10.jpg" alt="">
                <div class="text_box">
                    <span style="font-size: 20px;">펫 케어</span>
                    <h1>Pet Care</h1>
                    <span>동물종을 가리지 않아요!, 어떤 동물이던지 맡겨주세요.</span>
                </div>
            </div>

            <div class="img_move">
                <img src="../선수제공파일/B-Module/images/17.jpg" alt="">
                <div class="text_box">
                    <span style="font-size: 20px;">펫 케어</span>
                    <h1>Pet Care</h1>
                    <span>많은 동물도 수용가능!</span>
                </div>
            </div>

            <div class="img_move">
                <img src="../선수제공파일/B-Module/갤러리/images/puppy05.jpg" alt="">
                <div class="text_box">
                    <span style="font-size: 20px;">펫 케어</span>
                    <h1>다양한 활동</h1>
                    <span>동물에게 알맞는 활동을 해요, 강아지라면 산책!</span>
                </div>
            </div>
        </div>
        
               
        <div class="petceter">

            <div class="text">
                <span class="title">POPULAR SITTER</span>

                <h1>가장 많이 예약된<br>믿음직한 펫시터</h1>

                <span>후기와 재계약룰로 검증된 펫시터를 만나보세요. 각 펫시터의 태그를 통해 우리 아이에게 꼭 맞는 케어 스타일을 확인할 수 있어요</span>
            </div>

            <div class="petcenter_boxs">
                <div class="petcenter_box">
                    <div class="petcenter_img_box">
                        <span class="profile">
                            <img src="B-Module/펫시터/images/petsitter1.png" alt="">
                        </span>

                        <div>
                            <span>김민지</span>
                            <span>서울 강남구</span>
                        </div>
                    </div>

                    <div class="review">
                        <span>평점: 4.9 / </span>
                        <span>리뷰 수: 152 /</span>
                        <span>재계약률: 93%</span>
                    </div>

                    <div class="tag">
                        <span>산책</span>
                        <span>소형견</span>
                        <span>노령견 케어</span>
                    </div>

                    <hr>

                    <span>후기:매일 사진 보내주셔서 안심됐어요!</span>
                    
                    <div class="coin">
                        <div>
                            <span class="mouny">25,000원</span>
                            <span class="num">/1회</span>
                        </div>

                        <div class="coin_button_box">
                            <button class="reservation">예약하기</button>
                            <button class="favorites">♥</button>
                        </div>
                    </div>
                </div>

                <div class="petcenter_box">
                    <div class="petcenter_img_box">
                        <span class="profile">
                            <img src="B-Module/펫시터/images/petsitter2.png" alt="">
                        </span>

                        <div>
                            <span>이서연</span>
                            <span>부산 해운대구</span>
                        </div>
                    </div>

                    <div class="review">
                        <span>평점: 4.8 / </span>
                        <span>리뷰 수: 124 / </span>
                        <span>재계약률: 89%</span>
                    </div>

                    <div class="tag">
                        <span>고양이</span>
                        <span>약 먹이기</span>
                        <span> 실내놀이</span>
                    </div>

                    <hr>

                    <span>후기:고양이를 정말 잘 돌봐주세요.</span>
                    
                    <div class="coin">
                        <div>
                            <span class="mouny">가격: 30,000원</span>
                            <span class="num">/1회</span>
                        </div>

                        <div class="coin_button_box">
                            <button class="reservation">예약하기</button>
                            <button class="favorites">♥</button>
                        </div>
                    </div>
                </div>

                <div class="petcenter_box">
                    <div class="petcenter_img_box">
                        <span class="profile">
                            <img src="B-Module/펫시터/images/petsitter4.png" alt="">
                        </span>

                        <div>
                            <span>박지훈</span>
                            <span>대구 수성구</span>
                        </div>
                    </div>

                    <div class="review">
                        <span>평점: 4.7 / </span>
                        <span>리뷰 수: 111 / </span>
                        <span>재계약률: 85%</span>
                    </div>

                    <div class="tag">
                        <span>방문돌봄</span>
                        <span>대형견</span>
                        <span>산책</span>
                    </div>

                    <hr>

                    <span>후기:산책을 정말 열심히 해주세요.</span>
                    
                    <div class="coin">
                        <div>
                            <span class="mouny">가격: 22,000원</span>
                            <span class="num">/1회</span>
                        </div>

                        <div class="coin_button_box">
                            <button class="reservation">예약하기</button>
                            <button class="favorites">♥</button>
                        </div>
                    </div>
                </div>

                <div class="petcenter_box">
                    <div class="petcenter_img_box">
                        <span class="profile">
                            <img src="B-Module/펫시터/images/petsitter3.png" alt="">
                        </span>

                        <div>
                            <span>최유진</span>
                            <span>인천 연수구</span>
                        </div>
                    </div>

                    <div class="review">
                        <span>평점: 4.6 / </span>
                        <span>리뷰 수: 105 / </span>
                        <span>재계약률: 82%</span>
                    </div>

                    <div class="tag">
                        <span>소동물</span>
                        <span>위탁돌봄</span>
                        <span>24시간 케어</span>
                    </div>

                    <hr>

                    <span>후기:토끼를 정말 잘 돌봐주셨어요.</span>
                    
                    <div class="coin">
                        <div>
                            <span class="mouny">가격: 28,000원</span>
                            <span class="num">/1회</span>
                        </div>

                        <div class="coin_button_box">
                            <button class="reservation">예약하기</button>
                            <button class="favorites">♥</button>
                        </div>
                    </div>
                </div>

                <div class="petcenter_box">
                    <div class="petcenter_img_box">
                        <span class="profile">
                            <img src="B-Module/펫시터/images/petsitter5.png" alt="">
                        </span>

                        <div>
                            <span>정하늘</span>
                            <span>광주 북구</span>
                        </div>
                    </div>

                    <div class="review">
                        <span>평점: 4.9 / </span>
                        <span>리뷰 수: 188 / </span>
                        <span>재계약률: 95%</span>
                    </div>

                    <div class="tag">
                        <span>병원동행</span>
                        <span>노령견 케어</span>
                        <span>특수케어</span>
                    </div>

                    <hr>

                    <span>후기:병원 동행 서비스가 정말 좋았어요.</span>
                    
                    <div class="coin">
                        <div>
                            <span class="mouny">35,000원</span>
                            <span class="num">/1회</span>
                        </div>

                        <div class="coin_button_box">
                            <button class="reservation">예약하기</button>
                            <button class="favorites">♥</button>
                        </div>
                    </div>
                </div>

                <div class="petcenter_box">
                    <div class="petcenter_img_box">
                        <span class="profile">
                            <img src="B-Module/펫시터/images/petsitter6.png" alt="">
                        </span>

                        <div>
                            <span>한지우</span>
                            <span>대전 유성구</span>
                        </div>
                    </div>

                    <div class="review">
                        <span>평점: 4.5 / </span>
                        <span>리뷰 수: 101 / </span>
                        <span>재계약률: 80%</span>
                    </div>

                    <div class="tag">
                        <span>고양이</span>
                        <span>방문돌봄</span>
                        <span>실내놀이</span>
                    </div>

                    <hr>

                    <span>후기:정말 세심하게 돌봐주셨어요.</span>
                    
                    <div class="coin">
                        <div>
                            <span class="mouny">20,000원</span>
                            <span class="num">/1회</span>
                        </div>

                        <div class="coin_button_box">
                            <button class="reservation">예약하기</button>
                            <button class="favorites">♥</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button_box">
                <a href="sub.html">더보기</a>
            </div>

        </div>

        <div class="sns">

            <input hidden type="radio" name="animals" id="pat" checked>
            <input hidden type="radio" name="animals" id="dog">
            <input hidden type="radio" name="animals" id="cat">
            <input hidden type="radio" name="animals" id="hamster">
            <input hidden type="radio" name="animals" id="rabbit">

            <h2>sns갤러리</h2>

            <div class="sns_label">
                <label class="pat" for="pat">전체</label>
                <label class="dog" for="dog">강아지</label>
                <label class="cat" for="cat">고양이</label>
                <label class="hamster" for="hamster">햄스터</label>
                <label class="rabbit" for="rabbit">토끼</label>
            </div>

            <div class="sns_img">
                <img class="cat" style="object-fit: cover; border-radius: 20px; " src="../선수제공파일/B-Module/갤러리/images/cat01.jpg" alt="">
                <img class="dog" style="object-fit: cover; border-radius: 20px; height: 200px; width: 180px; " src="../선수제공파일/B-Module/갤러리/images/puppy01.jpg" alt="">
                <img class="hamster" style="object-fit: cover; border-radius: 20px; " src="../선수제공파일/B-Module/갤러리/images/hamster01.jpg" alt="">
                <img class="dog" style="object-fit: cover; border-radius: 20px; " src="../선수제공파일/B-Module/갤러리/images/puppy03.jpg" alt="">
                <img class="cat" style="object-fit: cover; border-radius: 20px; height: 300px;" src="../선수제공파일/B-Module/갤러리/images/cat04.jpg" alt="">
                <img class="rabbit" style="object-fit: cover; border-radius: 20px; " src="../선수제공파일/B-Module/갤러리/images/rabbit01.jpg" alt="">
            </div>
        </div>

        <div class="reservation">
            <h1 style="color: white;">예약,이런 방식으로 진행돼요.</h1>
            

            <div class="reservation_boxs">
                <div class="reservation_box">
                    <h4 class="reservation_circle">01</h4>
                    <span class="title">서비스 선택</span>
                    <span>원하는 돌봄 서비스와 펫시터를 선택합니다.</span>
                </div>

                <div class="reservation_box">
                    <h4 class="reservation_circle">02</h4>
                    <span class="title">예약 신청</span>
                    <span>예약 날짜와 요청 사항을 입력하여 예약을 진행합니다.</span>
                </div>

                <div class="reservation_box">
                    <h4 class="reservation_circle">03</h4>
                    <span class="title">예약 확인</span>
                    <span>펫시터가 예약 요청을 확인하고 가능 여부를 안내합니다.</span>
                </div>

                <div class="reservation_box">
                    <h4 class="reservation_circle">04</h4>
                    <span class="title">돌봄 진행</span>
                    <span>예약된 날짜에 맞춰 반려동물 돌봄 서비스를 진행합니다.</span>
                </div>

                <div class="reservation_box">
                    <h4 class="reservation_circle">05</h4>
                    <span class="title">후기 작성</span>
                    <span>서비스 이용 후 후기를 작성하고 평점을 남길 수 있습니다.</span>
                </div>
            </div>
            
        </div>
        

        <ul class="list_box">
            <h1>자주 묻는 질문</h1>
            

            <li>
                <input type="radio" name="FAQ" id="input1" hidden>

                <label for="input1">1. 질문: 예약은 어떻게 진행되나요?</label>

                <div class="front">
                    <div class="back">
                        <div class="back_inner">
                            답변: 원하는 펫시터를 선택한 후 예약 날짜와 요청 사항을 입력하면 예약이 진행됩니다.
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <input type="radio" name="FAQ" id="input2" hidden>
            
                <label for="input2">2. 질문: 비회원도 예약이 가능한가요?</label>
            
                <div class="front">
                    <div class="back">
                        <div class="back_inner">
                            답변: 예약 및 돌봄 서비스 신청은 로그인 후 이용할 수 있습니다.
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <input type="radio" id="input3" hidden  name="FAQ" >
            
                <label for="input3">3. 질문: 예약 취소는 어떻게 하나요?</label>
            
                <div class="front">
                    <div class="back">
                        <div class="back_inner">
                            답변: 마이페이지에서 예약 내역 확인 후 취소 버튼을 눌러 취소할 수 있습니다.
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <input type="radio" id="input4" hidden  name="FAQ" >
            
                <label for="input4">4. 질문: 어떤 반려동물을 돌볼 수 있나요?</label>
            
                <div class="front">
                    <div class="back">
                        <div class="back_inner">
                            답변: 강아지, 고양이, 소동물 등 다양한 반려동물 돌봄 서비스를 제공합니다.
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <input type="radio" id="input5" hidden  name="FAQ" >
            
                <label for="input5">5. 질문: 펫시터 지원은 누구나 가능한가요?</label>
            
                <div class="front">
                    <div class="back">
                        <div class="back_inner">
                            답변: 회원가입 후 펫시터 지원 페이지에서 지원할 수 있습니다.
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <input type="radio" id="input6" hidden  name="FAQ" >
            
                <label for="input6">6. 질문: 돌봄 서비스 신청 후 수정이 가능한가요?</label>
            
                <div class="front">
                    <div class="back">
                        <div class="back_inner">
                            답변: 신청 완료 후에는 관리자 확인 전까지 수정 및 취소가 가능합니다.
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        
    </main>

    <footer>

        <div class="footer-top">

            <div class="right">
                <a href="index.html"><img src="logo_w.png" alt=""></a>

            </div>


            <div class="list">
                <H3 style="color: white; font-weight: bold;">서비스 바로가기</H3>
                
                <ul>
                    <li><a href="#">인기 펫시터</a></li>
                    <li><a href="#">돌봄 서비스</a></li>
                    <li><a href="#">펫시터 지원</a></li>
                </ul>

                <ul>
                    <li><a href="#">예약하기</a></li>
                    <li><a href="#">마이페이지</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>

            <div class="list">
                <ul>
                    <li><a href="#">서비스 소개</a></li>
                    <li><a href="#">안심케어 가이드</a></li>
                </ul>
            </div>

        </div>

        <hr>

        <span class="email">Copyright © 2026 Skills PetCare. All Rights Reserved.</span>
    </footer>
</body>
</html>