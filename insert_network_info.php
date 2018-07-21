<?php

  require 'common.php';

  $data = array();
  if(isset($_POST['user_id']))  $data['added_by_user_id'] = $_POST['user_id'];
  if(isset($_POST['donor_name']))  $data['name'] = $_POST['donor_name'];
  if(isset($_POST['donor_phone']))  $data['phone'] = $_POST['donor_phone'];
  if(isset($_POST['donor_email']))  $data['email'] = $_POST['donor_email'];
  if(isset($_POST['relationship']))  $data['relationship'] = $_POST['relationship'];
  if(isset($_POST['address']))  $data['address'] = $_POST['address'];

  if(isset($_POST['address']))  $data['address'] = $_POST['address'];



  $data['donor_status'] = 'lead';
  $data['added_on'] = date('Y-m-d H:i:s');

  $insert_id = $fraise->insert_network_info($data);

  if($_POST['submit']=="Save"){
    header('location: index.php?success='.$insert_id);
  }
  else{
    header('location: add_donor.php?success='.$insert_id);
  }


  $additional_details = array();
  if(isset($_POST['age_bracket']))  $additional_details['age_bracket'] = $_POST['age_bracket'];
  if(isset($_POST['nach_potential']))  $additional_details['nach_potential'] = $_POST['nach_potential'];
  if(isset($_POST['otd_potential']))  $$additional_details['otd_potential'] = $_POST['otd_potential'];
