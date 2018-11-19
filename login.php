<?php 
	ob_start();
	session_start();
?>
<?php
// $memId = $_POST["memId"];
// $memPsw = $_POST["memPsw"];

$memId = "ke_Id";
$memPsw = "ke_Psw";

try{
	require_once("connectMember.php");
	$sql = "select * from member where member_Id = '$memId' and member_Psw = '$memPsw'";
	$member = $pdo -> query( $sql );
    if( $member->rowCount() == 0){
    	echo "帳密錯誤, 請<a href='login.html'>重新輸入</a>";
    }else{
    	$memRow = $member->fetchObject();
    	// echo $memRow->member_Id, ", 您好~~ <br>";
        //登入成功, 寫入session
        $_SESSION["member_No"] = $memRow->member_No; // 會員編號

        //是否從別支程式跳轉過來
          if(isset($_SESSION["where"]) == true){
            $where = $_SESSION["where"];
            unset( $_SESSION["where"]);
            header("location:$where");
          }
    }
}catch(PDOException $ex){
	echo "資料庫操作失敗,原因：",$ex->getMessage(),"<br>";
	echo "行號：",$ex->getLine(),"<br>";
}
?>	