<?php
// Headers
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');

// Connection
$conn=mysqli_connect('localhost','root','','school') or die('mysql not connected');

// Input Data
//$data=json_decode(file_get_contents("php://input"),true);

$name=$_POST['name'];
$price=$_POST['price'];
$code=$_POST['code'];
$description=$_POST['description'];
$company=$_POST['company'];
$photo=time().$_FILES["photo"]["name"];
move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . time().$_FILES["photo"]["name"]);


// Insert Query
$query="insert into products set
name='$name',price='$price',code='$code',description='$description',company='$company',photo='$photo'";

$result=mysqli_query($conn,$query);

// Set Response
if($result){
http_response_code(200);
$arr=['status'=>200,'msg'=>'Product Added Successfully'];
echo json_encode($arr);
}
else{
http_response_code(404);
$arr=['status'=>404,'msg'=>'Product Not Inserted'];
echo json_encode($arr);
}
?>