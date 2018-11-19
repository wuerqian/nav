<?php
ob_start();
session_start();
try{
  require_once("connectMember.php");
  $sql = "UPDATE member
          SET member_Pic = :member_Pic
          WHERE member_No = :member_No";

  $member = $pdo->prepare( $sql);
  $member->bindValue(":member_No", $_SESSION["member_No"]);
  $member->bindValue(":member_Pic", $_POST["memberPic"]);
  $member->execute();

}catch(PDOException $e){
  echo $e->getMessage();
}
?>