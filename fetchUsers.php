<?php
// Headers
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');

// Connection
$conn=mysqli_connect('localhost','root','','school') or die('mysql not connected');

// Insert Query
$query="select * from users";

$result=mysqli_query($conn,$query);
$myarray=array();
while($row = mysqli_fetch_assoc($result))
{
    $records=array(
        "id"=>$row['id'],
        "name"=>$row['name'],
        "email"=>$row['email'],
        "phone"=>$row['phone'],
        "city"=>$row['city'],
        "photo"=>$row['photo']
    );
    array_push($myarray,$records);
}

// Set Response
if($result){
http_response_code(200);
$arr=['msg'=>'User Record List','status'=>200,'records'=>$myarray];
echo json_encode($arr,JSON_PRETTY_PRINT);
}
else{
http_response_code(401);
$arr=['msg'=>'Record Not Found'];
echo json_encode($arr);
}
?>