<?php

  require 'common.php';
  
  if(isset($_GET['network_id'])){
    $fraise->deleteAll($_GET['network_id']);
    header('location: '.$config['site_home'].'index.php');
  }
  else{
    header('location: '.$config['site_home'].'index.php');
  }
