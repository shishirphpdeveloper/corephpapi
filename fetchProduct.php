<?php
// Headers
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');

// Connection
$conn=mysqli_connect('localhost','root','','school') or die('mysql not connected');
$id=$_GET['id'];
// Insert Query
$query="select * from products where id=$id";

$result=mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);

// Set Response
if($result){
http_response_code(200);
//$arr=['msg'=>'Record Insert Successfully'];
echo json_encode($row,JSON_PRETTY_PRINT);
}
else{
http_response_code(401);
$arr=['msg'=>'Record Not Inserted'];
echo json_encode($arr);
}
?>