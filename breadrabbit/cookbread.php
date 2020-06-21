<?php 
    require_once('lib/header_php.php'); 
    require_once("conn.php");
    require_once("lib/logchk.php");
    $url="cookbread.php";
    $kinds='';
    if(isset($_SESSION['user_id'])){
        $escaped_user_id=mysqli_real_escape_string($conn,$_SESSION['user_id']);
    }
    if(isset($_GET['kinds'])){
        $kinds=$_GET['kinds'];
    }
    $escaped_title='';
    $escaped_description='';
    $img_src='course';
    $formhref="cookbread_process.php";

    switch($kinds){
        case 'all':$pagesql="select count(*) totalCount from content";break;
        case 'mine':$pagesql="select count(*) totalCount from content where user_id={$_SESSION['user_id']}";break;
        default : $pagesql="select count(*) totalCount from content where kinds='{$kinds}'";break;
    }

    $pageresult=mysqli_query($conn,$pagesql);
    $pagerow=mysqli_fetch_array($pageresult);
    $total_article=$pagerow['totalCount'];//게시물 총 개수
    // print_r($total_article);

    
    // if(!$page)$page=1;
    // $start=($page-1)*$view_article;
    $start=0;
    $view_article=20;//페이지당 게시물 개수
    // $id='';
    // $option='';

    switch ($kinds) {
        case 'all':$sql="select * from content limit $start, $view_article";break;
        case 'mine':$sql= "select * from content where user_id={$_SESSION['user_id']} limit $start, $view_article";break;
        default:$sql= "select * from content where kinds='{$kinds}' limit $start, $view_article";break;
    }
    $result=mysqli_query($conn,$sql);
    $content='';
    while($row=mysqli_fetch_array($result)){
        $content=$content.
        '
            <a href="content.php?id='.$row['id'].'">
                <div class="content">
                    <div class="title">'.$row['title'].'</div>
                    <div class="views">'.$row['views'].'</div>
                </div>
            </a>
        ';
    }
    // include("lib/page.php");
    //재료 개수
    $sql= "select * from material where user_id='{$_SESSION['id']}'";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $total = $row['total'];
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>빵 굽기 화면</title>
        <link href="css/cookbread.css" rel="stylesheet"> 
        <style type = "text/css">
            @import url("css/header.css");
        </style>
        <script src="js/header.js"></script>
        <script src="js/cookbread.js"></script>
    </head>

    <body onload="clickpost('<?=$kinds?>')">
    <div class="over" id="over" style="display:none" onclick="clickover('<?=$url?>')" >
    
        <div class="post" id="post" style="display:none; overflow:auto; width:700px; height:400px">
            <div class="list">

                <!-- <div class="post">게시물 <span class="totalNum">(<?=$total_article?>)</span></div> -->
                <div class="top">
                    <div class="top-title">제목</div>
                    <div class="top-views">조회수</div>
                </div>
                <div class="contentBox">
                    <?=$content?>
                </div>
                <!-- <div class="number">
                    <span class="numberPrev"><?=$prev_group?> </span>
                    <span class="numberPaging"><?=$paging?> </span>
                    <span class="numberNext"><?=$next_group?> </span>            
                </div> -->
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="breadlist">
            <div class="bread">
                <img src="images/course.png" onclick="clickpost('course'); clickLocation('course');">
                <div class="title">
                    진로
                </div>
                <div class="explain">
                    설명
                </div>
            </div>
            <div class="bread">
                <img src="images/family.png" onclick="clickpost('family'); clickLocation('family');">
                <div class="title">
                    가족
                </div>
                <div class="explain">
                    설명
                </div>
            </div>
            <div class="bread">
               <img src="images/friend.png" onclick="clickpost('friend'); clickLocation('friend');">
                <div class="title">
                    친구
                </div>
                <div class="explain">
                    설명
                </div>
            </div>
            <div class="bread">
                 <img src="images/love.png" onclick="clickpost('love'); clickLocation('love');">
                <div class="title">
                    연애
                </div>
                <div class="explain">
                    설명
                </div>
            </div>
            <div class="bread">
                <img src="images/other.png" onclick="clickpost('other'); clickLocation('other');">
                <div class="title">
                    기타
                </div>
                <div class="explain">
                    설명
                </div>
            </div>
        </div>
    </div>          
    <?php
        require_once("lib/header_html.php");
        require_once("lib/write.php");
    ?>
                <input type="hidden" name="user_id" value="<?=$escaped_user_id?>">
                <input type="submit" id="submitButton" name="submit" alt="빵 굽기!" value="빵 굽기">

                <div class="total">
                    <p>남은 재료 개수 : <?= $total?>개</p>
                </div>
            </div>
        </form>
        
    </body>
</html>