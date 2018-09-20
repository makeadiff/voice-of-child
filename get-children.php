<?php
  require 'common.php';
  if(isset($_GET['shelter_id'])){
    $child_list = $voc->get_child_list_shelter($_GET['shelter_id']);
    print json_encode($child_list);
  }
?>
