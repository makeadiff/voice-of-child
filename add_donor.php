<?php
  require 'common.php';

  $network_info = array();

  $addition_details = false;

  if(isset($_GET['network_id'])){
    $donor_id = $_GET['network_id'];
    $network_info = $fraise->get_network($donor_id);
    $addition_details = $fraise->check_additional_details($donor_id);
  }






  if(isset($_GET['success'])){
    $added_id = $_GET['success'];
    $added_donor = $fraise->get_network($added_id);
  }




  render();
?>
