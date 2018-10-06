<?php
include("../lib/dbconn.php");

$db=new databaseqlsv("");

if(isset($_POST['MAMH'])){
	if(isset($_POST['TENMH'])){
		$tenmh=$_POST['TENMH'];
		}
	if(isset($_POST['SOTC'])){
		$sotc=$_POST['SOTC'];
		}
	if($db->isValid()){
		$mamh=$_POST['MAMH'];
	    $sql="UPDATE monhoc SET TENMH='$tenmh', SOTC='$sotc' WHERE MAMH='$mamh'";
	    $db->execute($sql);
		$db->close();
		
		include("../api_monchoc/getlistmonhoc.php");
	}
	else{
		echo 'fail';
		}
}
else{
	
	echo 'fail';
	}
	
	
?>