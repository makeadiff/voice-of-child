<?php
  require 'common.php';

  $data = true;

  if(isset($_GET['child_id'])){
    $child_id = $_GET['child_id'];
    $child_info = $voc->get_child_info($child_id);
    $all_comments_child = $voc->get_all_comments_child($user['id'],$child_id);
  }
  else{
    $data=false;
  }

  render();
?>
