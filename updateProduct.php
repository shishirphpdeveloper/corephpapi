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

$query="select * from products where id=$id";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
//echo "upload/".$row['photo'];
//if($row['photo'])
//unlink("upload/".$row['photo']);


$name=$_POST['name'];
$price=$_POST['price'];
$code=$_POST['code'];
$description=$_POST['description'];
$company=$_POST['company'];
$photo=time().$_FILES["photo"]["name"];
move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . time().$_FILES["photo"]["name"]);


// Update Query
$query="update products set
name='$name',price='$price',code='$code',description='$description',company='$company',photo='$photo',photo='$photo' where id='$id'";

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