<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');


$conn=mysqli_connect('localhost','root','','school') or die('mysql not connected');
require("phpjwt/src/BeforeValidException.php");
require("phpjwt/src/ExpiredException.php");
require("phpjwt/src/JWK.php");
require("phpjwt/src/JWT.php");
require("phpjwt/src/SignatureInvalidException.php");
use Firebase\JWT\JWT;

$email=$_POST['email'];
$password=$_POST['password'];
$query="select * from users where email='$email'";
$result=mysqli_query($conn,$query);
$countrow=mysqli_num_rows($result);
$row=mysqli_fetch_array($result);

$myarray=array();

if($countrow>0)
{
    $verify=password_verify($password,$row['password']);    

    $key="test123";

	$payload=array(
				"id"=>$row['id'],
				"name"=>$row['name'],
				"email"=>$row['email'],
	);

    if($verify){
        $jwt=JWT::encode($payload,$key);
        $userrecord=$payload;
        $userrecord['token']=$jwt;
        $arr=['msg'=>'Login Successfully','status'=>200,'records'=>$userrecord];
	
    }
    else{
        $arr=['msg'=>'Login Unsuccessfully','status'=>400,'records'=>null];
    }
	
	echo json_encode($arr);
}
else
{
	$arr=['msg'=>'No Record Found','status'=>400];
	echo json_encode($arr);
}

?>