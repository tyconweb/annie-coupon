<?php
require '../includes/site/db.php';
if(isset($_POST['coupons']) && !empty($_POST['coupons'])){
  $coupons = $_POST['coupons'];
  foreach($coupons as $coupon){
    $id = $coupon['id'];
    $position = $coupon['position'];
    // prepare the update query
    $query = "UPDATE coupons SET order_id = '$position' WHERE id = '$id'";
    mysqli_query($db, $query);
  }
  // send a success response back to the AJAX request
  echo json_encode(array('success' => true));
} else {
  // send an error response back to the AJAX request
  echo json_encode(array('success' => false, 'error' => 'No coupons were received.'));
}
