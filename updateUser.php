<?php
// Headers
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');

// Connection
$conn=mysqli_connect('localhost','root','','school') or die('mysql not connected');

$id=$_POST['id'];

$query="select * from users where id=$id";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
//echo "upload/".$row['photo'];
if($row['photo'])
unlink("upload/".$row['photo']);


$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$city=$_POST['city'];
$photo=time().$_FILES["photo"]["name"];
move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . time().$_FILES["photo"]["name"]);


// Insert Query
$query="update users set
name='$name',email='$email',phone='$phone',city='$city',photo='$photo' where id='$id'";

$result=mysqli_query($conn,$query);

// Set Response
if($result){
http_response_code(200);
$arr=['status'=>200,'msg'=>'Record Update Successfully'];
echo json_encode($arr);
}
else{
http_response_code(404);
$arr=['status'=>404,'msg'=>'Record Not Update'];
echo json_encode($arr);
}
?>