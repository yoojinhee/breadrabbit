<?php  
require_once("lib/header_php.php");
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>상담</title>
        <style type = "text/css">
          @import url("css/header.css");
        </style>
        <link href="css/chatIntro.css" rel="stylesheet"> 
        <script src="js/header.js"></script>
        <script src="js/chatIntro.js"></script>
    </head>
    <body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

        <?php  
        require_once("lib/header_html.php");
        ?>
      <div class="container">
        <div class="Intro">
            <div class="title">
                상담하기
            </div>
            <div class="content">
                실시간으로 고민을 상담해보세요
            </div>
            <div class="imagee">
            <div id="wrap">
                <div class="fade_container">
                    <img class="active" src="images/chat_1.png" alt="image1" />
                    <img src="images/chat_2.png" alt="image2" />
                    <img src="images/chat_3.png" alt="image3" />
                    <img src="images/chat_4.png" alt="image3" />
                    <img src="images/chat_5.png" alt="image3" />
                    <img src="images/chat_6.png" alt="image3" />
                </div>
            </div>
            </div>
            
            
            
            
            <div class="sub">
                <div class="subContent">
                    닉네임 입력하기            
                </div>
                <div class="inputBox">
                    <div>
                        <p class="inputName">닉네임을 작성해주세요</p>
                        <div>
                            <form method="POST" action="chatting.php">
                                <input type="text" name="nikname" class="inputnikname">
                            </form>
                        </div>
                    </div>
                </div>
                <button class="chattingButton" onclick="window.location.href='chatting.php'" >채팅 하러 가기</button>
            </div>
            
        </div>

      </div>

      
    </body>
</html>