<?php

  require 'common.php';

  dump($_POST);

  $data = array();
  if(isset($_POST['network_id'])) $id = $_POST['network_id'];
  if(isset($_POST['pledge_type']))  $data['pledge_type'] = $_POST['pledge_type'];
  if(isset($_POST['pledged_amount']))  {
    $data['pledged_amount'] = $_POST['pledged_amount'];
    $data['donor_status'] = 'pledged';
  }

  if(isset($_POST['donor_email']))  $data['email'] = $_POST['donor_email'];
  if(isset($_POST['donor_address']) && $_POST['donor_address']!='')  $data['address'] = $_POST['donor_address'];
  if(isset($_POST['donor_pincode']) && $_POST['donor_address']!='')  $data['address'] .= ' PIN: '.$_POST['donor_pincode'];
  if(isset($_POST['collection_by']))  $data['collection_by'] = $_POST['collection_by'];
  if(isset($_POST['collect_on']))  $data['collect_on'] = date('Y-m-d H:i:s',strtotime($_POST['collect_on']));

  $data['added_on'] = date('Y-m-d H:i:s');

  dump($data);

  $fraise->update_pledge_info($id,$data);

  header('location: ./index.php');
