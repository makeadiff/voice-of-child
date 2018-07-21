<?php
  require 'common.php';

  $network_data = $fraise->get_network_info($user_id);
  $total_pledge = $fraise->get_total_pledge($user_id);


  if(isset($_GET['success'])){
    $added_id = $_GET['success'];
    $added_donor = $fraise->get_network($added_id);
  }

  // $total_pledge = $fraise->get_total_collected($user_id);

  render();
?>
