<?php
header('Content-Type: application/json');
include("../apiqlsv/lib/data.php");
include("../apiqlsv/lib/dbconn.php");
  
//Test
$res = null;
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM taikhoan  WHERE TENDANGNHAP='$username'";
    // ket noi database
    $dbconnection = new databaseqlsv("");
    $result = $dbconnection->select($sql);
    if ($result !== null) {
        if (mysqli_num_rows($result) > 0) {
            //user exist, check password
            $dbpassword = null;
            $user = null;
            while ($data = mysqli_fetch_object($result)) {
                $dbpassword = $data->MATKHAU;
                $user = $data;
                break;
            }
            if ($dbpassword !== null) {
                   if (strcasecmp($dbpassword, $password) == 0) {
					   if($user!==null){
						   unset($user->MATKHAU); 
					       $res->data=$user;
					       $res->error=Constant::SUCCESS;
					       $res->message="login success";
					      // $res=new Result(Constant::SUCCESS,"Login success",$res->data);
						  }
                      
                  }else {
                    $res = new Result(Constant::INVALID_PASSWORD, 'Password is not matching.');
                }
            } else {
                $res = new Result(Constant::GENERAL_ERROR, 'There was an error while processing request. Please try again later.');
            }
        } else {
            $res = new Result(Constant::INVALID_USER, 'User is not exist');
        }
     
    } else {
        $res = new Result(Constant::GENERAL_ERROR, 'There was an error while processing request. Please try again later.');
    }
    $dbconnection->close();
    
} else {
    $res = new Result(Constant::INVALID_PARAMETERS, 'Invalid parameters.');
}
echo (json_encode($res));