<?php
  require 'common.php';

  $city_list = $voc->get_city_list();
  $shelter_list = $voc->get_shelter_list($user['city_id']);

  $child_list = $voc->get_child_list($user['city_id']);

  render();
?>
