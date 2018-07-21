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


  if(isset($_POST['insert_id']) && $_POST['insert_id']!=0 && $_POST['insert_id']!=''){
    unset($data['donor_status']);
    $insert_id = $fraise->update_network_info($data,$_POST['insert_id']);
  }
  else{
    $insert_id = $fraise->insert_network_info($data);
  }

  $additional_details = array();

  if(isset($_POST['age_bracket'])){
    $additional_details[0]['donut_network_id'] = $insert_id;
    $additional_details[0]['name'] = 'age_bracket';
    $additional_details[0]['value'] = $_POST['age_bracket'];
    $additional_details[0]['added_on'] = date('Y-m-d H:i:s');
  }
  if(isset($_POST['nach_potential'])){
    $additional_details[1]['donut_network_id'] = $insert_id;
    $additional_details[1]['name'] = 'nach_potential';
    $additional_details[1]['value'] = $_POST['nach_potential'];
    $additional_details[1]['added_on'] = date('Y-m-d H:i:s');
  }
  if(isset($_POST['otd_potential']))  {
    $additional_details[2]['donut_network_id'] = $insert_id;
    $additional_details[2]['name'] = 'otd_potential';
    $additional_details[2]['value'] = $_POST['otd_potential'];
    $additional_details[2]['added_on'] = date('Y-m-d H:i:s');
  }
  if(isset($_POST['giving_likelihood']))  {
    $additional_details[3]['donut_network_id'] = $insert_id;
    $additional_details[3]['name'] = 'giving_likelihood';
    $additional_details[3]['value'] = $_POST['giving_likelihood'];
    if(isset($_POST['giving_likelihood_reason'])) $additional_details[3]['data'] = $_POST['giving_likelihood_reason'];
    $additional_details[3]['added_on'] = date('Y-m-d H:i:s');
  }
  if(isset($_POST['nach_likelihood']))  {
    $additional_details[4]['donut_network_id'] = $insert_id;
    $additional_details[4]['name'] = 'nach_likelihood';
    $additional_details[4]['value'] = $_POST['nach_likelihood'];
    if(isset($_POST['nach_likelihood_reason'])) $additional_details[4]['data'] = $_POST['nach_likelihood_reason'];
    $additional_details[4]['added_on'] = date('Y-m-d H:i:s');
  }
  if(isset($_POST['online_likelihood']))  {
    $additional_details[5]['donut_network_id'] = $insert_id;
    $additional_details[5]['name'] = 'online_likelihood';
    $additional_details[5]['value'] = $_POST['online_likelihood'];
    if(isset($_POST['online_likelihood_reason'])) $additional_details[5]['data'] = $_POST['online_likelihood_reason'];
    $additional_details[5]['added_on'] = date('Y-m-d H:i:s');
  }

  $fraise->update_additional_details($additional_details);


  if($_POST['submit']=="Save"){
    header('location: index.php?success='.$insert_id);
  }
  else{
    header('location: add_donor.php?success='.$insert_id);
  }
