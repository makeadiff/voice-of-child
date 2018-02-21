<?php

  include ('../../common.php');

  $user_id = $_SESSION['user_id'];

  $db = $config_data['db_database'];
  $db_host = $config_data['db_host'];
  $db_name = $config_data['db_user'];
  $db_pass = $config_data['db_password'];

  $query_user= "SELECT * FROM User WHERE id = ".$user_id;

  $user = $sql->getAll($query_user);
  $user = $user[0];
  //Query to get all user from city for referral
  $query_all_users ="SELECT
                      User.id,
                      User.name AS user_name,
                      City.name AS city_name
                     FROM User
                     INNER JOIN City ON City.id= User.city_id
                     INNER JOIN UserGroup as UG on UG.user_id = User.id
                     WHERE user_type = 'volunteer'
                      AND status = 1
                      AND UG.year = 2017
                      AND User.city_id = ".$user['city_id'].'
                     GROUP BY User.id';

  $all_users = $sql->getAll($query_all_users);

  $volunteer= array();
  foreach ($all_users as $users) {
    $volunteer[] = $users['user_name'].' / '.$users['id'];
  }

  //Query to get all questions and answer from survey table

  $survey_id = 7;

  $query_qna="SELECT
                question_id,
                question,
                SS_Answer.id AS answer_id,
                answer
              FROM SS_Answer
              INNER JOIN SS_Question ON SS_Answer.question_id=SS_Question.id
              WHERE survey_event_id = ".$survey_id."
              AND question<>'Are you planning to continue with MAD in 2018-19?'
              ORDER BY question_id";

  $result = $sql->getAll($query_qna);

  //Roles query

  $query_roles_fellow="SELECT * from `Group` WHERE type='fellow' AND group_type='normal' AND status=1";
  $fellow_roles_data = $sql->getAll($query_roles_fellow);

  $roles = array();
  $i=0;

  foreach ($fellow_roles_data as $role) {
    $roles[$i]['id'] = $role['id'];

    if($role['name']=='Propel Fellow'){
      $roles[$i]['name']='Transition Readiness and Aftercare Fellow';
    }
    else if($role['name']=='Center Head'){
      $roles[$i]['name']='Shelter Operations Fellow';
    }
    else if($role['name']=='FR Fellow'){
      $roles[$i]['name']='Fundraising Fellow';
    }
    else if($role['name']=='Finance Controller'){
      $roles[$i]['name']='Finance Fellow';
    }
    else if($role['name']=='HC Fellow'){
      $roles[$i]['name']='Human Capital Fellow';
    }
    else if($role['name']=='PR Fellow'){
      $roles[$i]['name']='Public Relations Fellow';
    }
    else{
      $roles[$i]['name']=$role['name'];
    }
    $i++;
  }

  $options_fellow = '';
  foreach ($roles as $role) {
    $options_fellow .= '<option value="'.$role['id'].'">'.$role['name'].'</option>';
  }

  $query_roles_vol="SELECT * from `Group` WHERE type='volunteer' AND group_type='normal' AND status=1 AND (name LIKE '%mentor%' OR name LIKE '%wingman%')";
  $volunteer_roles_data = $sql->getAll($query_roles_vol);

  $volunteer_roles = array();
  $i = 0;

  foreach ($volunteer_roles_data as $role) {
    $volunteer_roles[$i]['id'] = $role['id'];

    if($role['name']=='Propel Wingman'){
      $volunteer_roles[$i]['name'] = 'Transition Readiness Wingman';
    }
    else if($role['name']=='Mentors'){
      $volunteer_roles[$i]['name'] = 'Mentor';
    }
    else{
      $volunteer_roles[$i]['name'] = $role['name'];
    }
    $i++;
  }

  $options_volunteer = '';
  foreach ($volunteer_roles as $role) {
    $options_volunteer .= '<option value="'.$role['id'].'">'.$role['name'].'</option>';
  }

?>
