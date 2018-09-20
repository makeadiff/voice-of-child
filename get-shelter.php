<?php
  require 'common.php';
  if(isset($_GET['city_id'])){
    $shelter_list = $voc->get_shelter_list($_GET['city_id']);
    print json_encode($shelter_list);
  }
?>
