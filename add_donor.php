<?php
  require 'common.php';

  if(isset($_GET['network_id'])){
    $donor_id = $_GET['network_id'];
  }

  if(isset($_GET['success'])){
    $added_id = $_GET['success'];
    $added_donor = $fraise->get_network($added_id);
  }



  render();
?>
