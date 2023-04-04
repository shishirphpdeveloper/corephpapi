<?php
// Headers
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:POST,PUT,GET,DELETE');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');

// Connection
$conn=mysqli_connect('localhost','root','','school') or die('mysql not connected');

// Input Data
//$data=json_decode(file_get_contents("php://input"),true);

$id=$_GET['id'];

// Insert Query
$query="delete from products where id='$id'";

$result=mysqli_query($conn,$query);

// Set Response
if($result){
http_response_code(200);
$arr=['status'=>200,'msg'=>'Record Delete Successfully'];
echo json_encode($arr);
}
else{
http_response_code(404);
$arr=['status'=>404,'msg'=>'Record Not Update'];
echo json_encode($arr);
}
?>