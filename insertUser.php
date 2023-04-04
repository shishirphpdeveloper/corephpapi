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

$name=$_POST['name'];
$email=$_POST['email'];
$password=password_hash($_POST['password'], PASSWORD_BCRYPT);
$phone=$_POST['phone'];
$city=$_POST['city'];
$photo=time().$_FILES["photo"]["name"];
move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . time().$_FILES["photo"]["name"]);


// Insert Query
$query="insert into users set
name='$name',email='$email',password='$password',phone='$phone',city='$city',photo='$photo'";

$result=mysqli_query($conn,$query);

// Set Response
if($result){
http_response_code(200);
$arr=['status'=>200,'msg'=>'Record Insert Successfully'];
echo json_encode($arr);
}
else{
http_response_code(401);
$arr=['msg'=>'Record Not Inserted'];
echo json_encode($arr);
}
?>