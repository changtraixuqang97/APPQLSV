<?php
include("../lib/dbconn.php");
  $db = new databaseqlsv("");
  class monhoc{
	  function monhoc($mamh,$tenmh,$sotc){
		  $this->MaMH=$mamh;
		  $this->TenMH=$tenmh;
		  $this->SoTC=$sotc;
		  }
	  }
  $arrMonHoc=array();
  while($data=mysqli_fetch_array($db->select("SELECT * FROM monhoc"))){
	  array_push($arrMonHoc,new monhoc($data['MAMH'],$data['TENMH'],$data['SOTC'])); 
	  }
  echo json_encode($arrMonHoc);
 
 ;
?>