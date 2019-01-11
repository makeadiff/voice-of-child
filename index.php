<?php
  require 'common.php';



  $success = false;

  if(isset($_GET['success']) && $_GET['success']==1){
    $success = true;
  }

  $data = array();
  $data['shelter_id'] = i($QUERY,'shelter_id','');
  $data['city_id'] = i($QUERY,'city_id','');

  $data['question_type'] = i($QUERY,'question_type','');
  $data['actionable'] = i($QUERY,'actionable','');

  $all_comments = $voc->get_all_comments($user['id'],$is_director,$data);

  $shelter_list = $voc->get_shelter_list($user['city_id']);
  $child_list = $voc->get_child_list($user['city_id']);
  $city_list = $voc->get_city_list();

  if(!empty($all_comments)){

    $count = array();
    $count['inform']=0;
    $count['caution']=0;
    $count['escalate']=0;
    $count['total']=0;

    foreach ($all_comments as $comments) {
      if($comments['actionable']=='inform'){
        $count['inform']++;
      }
      elseif($comments['actionable']=='caution'){
        $count['caution']++;
      }
      elseif($comments['actionable']=='escalate'){
        $count['escalate']++;
      }
    }

    $count['total'] = $count['inform']+$count['caution']+$count['escalate'];
  }

  render();
?>
