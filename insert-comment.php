<?php

  require 'common.php';
  dump($_POST);


  if(isset($_POST['question_count'])) $question_count = $_POST['question_count'];
  else $question_count = 1;

  for ($i=0; $i < $question_count ; $i++) {
    if(isset($_POST['child_id'])) $data['student_id'] = $_POST['child_id'];
    if(isset($_POST['added_by_user_id'])) $data['added_by_user_id'] = $_POST['added_by_user_id'];
    if(isset($_POST['question_'.$i])) $data['question'] = $_POST['question_'.$i];
    if(isset($_POST['answer_'.$i])) $data['answer'] = $_POST['answer_'.$i];
    if(isset($_POST['question_type_'.$i])) $data['type'] = $_POST['question_type_'.$i];
    if(isset($_POST['question_tag_'.$i])) $data['tags'] = $_POST['question_tag_'.$i];
    if(isset($_POST['actionable_'.$i])) $data['actionable'] = $_POST['actionable_'.$i];
    $data['escalation_status'] = 'none';
    $data['added_on'] = date('Y-m-d H:i:s');

    $insert_id = $voc->insert_comment($data);
  }

  header('location: index.php?success=1');

?>
