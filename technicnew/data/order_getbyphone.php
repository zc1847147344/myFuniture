<?php
header("Content-Type:application/json");

@$phone = $_REQUEST['phone'];
if(empty($phone))
{
    echo '[]';
    return;
}

require('init.php');

$sql = "select ts_order.user_name,ts_order.did,ts_order.oid,ts_order.order_time,ts_order.addr,ts_dish.img_sm from ts_dish,ts_order where ts_order.did=ts_dish.did AND ts_order.phone='$phone'";
$result = mysqli_query($conn,$sql);
$output = [];
while(true)
{
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
        break;
    }
    $output[] = $row;
}

echo json_encode($output);



?>