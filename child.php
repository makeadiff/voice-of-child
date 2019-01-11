<?php
  require 'common.php';

  $child_data = true;

  if(isset($_GET['child_id'])){
    $child_id = $_GET['child_id'];
    $data = json_decode(str_replace('\'','"',$_GET['data']),TRUE);
    $child_info = $voc->get_child_info($child_id);
    $all_comments_child = $voc->get_all_comments_child($user['id'],$child_id,$data);
  }
  else{
    $child_data=false;
  }

  render();
?>
