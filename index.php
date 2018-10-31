<?php
  require 'common.php';

  $success = false;

  if(isset($_GET['success']) && $_GET['success']==1){
    $success = true;
  }
  $all_comments = $voc->get_all_comments($user['id']);

  render();
?>
