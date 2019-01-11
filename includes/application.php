<?php

  $user_info = check_user();
  $user_id = $user_info['user_id'];

  $is_director = false;

  if(!is_fellow($user_id,$year,$sql)){
    header('location: error.php');
  }

  $voc = new VOC;

  // $fraise->getenumValues('Donut_Network','relationship');

  $query_user= "SELECT * FROM User WHERE id = ".$user_id;

  $user = $sql->getAll($query_user);
  $user = $user[0];

  $question_type = array(
    'operations' => 'Operations',
    'foundational_programme' => 'Foundational Programme',
    'ed_support' => 'Ed Support',
    'transition_readiness' => 'Transition Readiness',
    'shelter' => 'Shelter Related',
    'personal' => 'Personal',
    'school' => 'School Related',
    'volunteer' => 'Volunteer Related',
    'other' => 'Other'
  );

  $actionable = array(
    'inform' => 'Information/Documentation',
    // 'citylevel' => 'Requires Plan'
    'caution' => 'Caution/Warning',
    'escalate' => 'Escalate',
  );

  // ---------------------- Functions -------------------------


  function is_fellow($user_id,$year,$sql){
    $check_q = 'SELECT DISTINCT G.type
                FROM UserGroup UG
                INNER JOIN `Group` G ON G.id = UG.group_id
                WHERE UG.user_id ='.$user_id.'
                AND G.type <> "volunteer"
                AND UG.year='.$year;
    $groups = $sql->getCol($check_q);
    if(in_array('national',$groups)){
      $GLOBALS['is_director'] = true;
      // return true;
    }

    if(in_array('fellow',$groups) || in_array('strat',$groups) || in_array('national',$groups) || in_array('executive',$groups)){
      return true;
    }
    else{
      return false;
    }
  }

  function create_select($array,$name,$response=null, $req = false,$empty=true){

    if($req)
      $output = '<select name='.$name.' id="'.$name.'" required>';
    else
      $output = '<select name='.$name.' id="'.$name.'">';

    if($empty){
      $output .= '<option value="">-- Select -- </option>';
    }

    foreach ($array as $key => $value) {
      if(isset($value['name'])){
        $value=$value['name'];
      }
      if($key==$response){
        $selected = 'selected';
      }
      else{
        $selected = '';
      }
      $output .= '<option value='.$key.' '.$selected.'>';
      $output .= $value;
      $output .= '</option>';
    }
    $output .= '</select>';

    return $output;
  }

  function create_radio($array,$name,$response=null, $req = false){

    $output = '<p class="form-label">';
    foreach ($array as $key => $value) {
      if($key==$response){
        $checked = 'checked';
      }
      else{
        $checked = '';
      }
      $output .= '<input class="radio-button-left" type="radio" id="'.$name.$key.'" name='.$name.' value="'.$key.'" '.$checked.'/>';
      $output .= '<label for="'.$name.$key.'">';
      $output .= $value;
      $output .= '</label>';
      $output .= '<br>';
    }
    $output .= '</p>';

    return $output;
  }

  function form_value($array,$key){
    if(isset($array[$key])){
      return $array[$key];
    }
    else{
      return '';
    }
  }
