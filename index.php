<?php
  require 'common.php';

  $success = false;

  if(isset($_GET['success']) && $_GET['success']==1){
    $success = true;
  }
  $all_comments = $voc->get_all_comments($user['id'],$is_director);

  $shelter_list = $voc->get_shelter_list($user['city_id']);
  $child_list = $voc->get_child_list($user['city_id']);
  $city_list = $voc->get_city_list();
  render();
?>
