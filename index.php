<?php
  require 'common.php';

  $all_comments = $voc->get_all_comments($user['id']);

  render();
?>
