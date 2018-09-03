<?php
  require 'common.php';

  $shelter_list = $voc->get_shelter_list($user['city_id']);

  $child_list = $voc->get_child_list($user['city_id']);

  render();
?>
