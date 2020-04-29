<?php  

require_once("conn.php");
$filtered=array(
	'id'=>mysqli_real_escape_string($conn,$_GET['id']),
    'user_id'=>mysqli_real_escape_string($conn,$_GET['user_id']),
	// content id
);
$sql="select * from content where id={$filtered['id']}";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$escaped_title=htmlspecialchars($row['title']);
$escaped_description=htmlspecialchars($row['description']);
$escaped_kinds=htmlspecialchars($row['kinds']);
$formhref="update_process.php";

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <link href="css/cookbread.css" rel="stylesheet">   
</head>
<?php
    require_once("lib/write.php");
?>
            <input type="hidden" name="content_id" value="<?=$filtered['id']?>">
            <input type="hidden" name="user_id" value="<?=$filtered['user_id']?>">
            <input type="submit" id="submitButton" name="submit" alt="빵 굽기!" value="">
        </div>
    </form>

    <script src="js/cookbread.js"></script>
</body>
</html>