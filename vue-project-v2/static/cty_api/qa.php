<?php
include ("connection.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type");
$id = $_POST['id'];
//建立SQL語法
$sql = "SELECT ms.MESSAGE,ms.SENDER,m.MEMBER_ID,m.UNSOLVED_PROBLEM 
FROM `MESSAGE` ms 
JOIN MEMBER m 
	ON ms.MEMBER_ID = m.MEMBER_ID 
    WHERE ms.MEMBER_ID = ?;";
$statement = getPDO()->prepare($sql);
$statement -> bindValue(1,$id);
$statement -> execute();
$data = $statement->fetchAll();
// print_r(COUNT($data));
if(COUNT($data)>0){
    echo json_encode($data);
}else{
$sql="INSERT INTO `MESSAGE` (`MESSAGE`, `SENDER`, `MEMBER_ID`) VALUES ('請輸入您的問題', '0', ?);";
$statement = getPDO()->prepare($sql);
$statement -> bindValue(1,$id);
$statement -> execute();
$sql2 = "SELECT ms.MESSAGE,ms.SENDER,m.MEMBER_ID,m.UNSOLVED_PROBLEM 
FROM `MESSAGE` ms 
JOIN MEMBER m 
	ON ms.MEMBER_ID = m.MEMBER_ID 
    WHERE ms.MEMBER_ID = ?;";
$statement2 = getPDO()->prepare($sql2);
$statement2 -> bindValue(1,$id);
$statement2 -> execute();
$data3 = $statement2->fetchAll();
}
?>