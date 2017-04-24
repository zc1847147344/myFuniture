<?php
/**根据用户id查询订单数据**/
header('Content-Type:application/json');

$output = [];

@$userid = $_REQUEST['userid'];

if(empty($userid)){
    echo "[]"; //若客户端未提交用户id，则返回一个空数组，
    return;    //并退出当前页面的执行
}

//访问数据库
require('init.php');

$sql = "SELECT ts_order.oid,ts_order.userid,ts_order.phone,ts_order.addr,
ts_order.totalprice,ts_order.user_name,ts_order.order_time,
ts_orderdetails.did,ts_orderdetails.dishcount,ts_orderdetails.price,
ts_dish.name,ts_dish.img_sm

 from ts_order,ts_orderdetails,ts_dish
WHERE ts_order.oid = ts_orderdetails.oid and ts_orderdetails.did = ts_dish.did and ts_order.userid='$userid'";
$result = mysqli_query($conn, $sql);

$output['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($output);
?>
