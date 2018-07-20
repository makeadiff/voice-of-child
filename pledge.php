<?php
  require 'common.php';

  if(isset($_GET['network_id'])){
    $network_id = $_GET['network_id'];
  }


  $network_info = $fraise->get_network($network_id);
  // $network_data = $fraise->get_network_info($user_id);




  render();
?>
