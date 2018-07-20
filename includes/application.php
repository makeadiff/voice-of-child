<?php

  $user_info = check_user();
  $user_id = $user_info['user_id'];

  $fraise = new FRaise;

  // $fraise->getenumValues('Donut_Network','relationship');

  $query_user= "SELECT * FROM User WHERE id = ".$user_id;

  //Array of Drop Downs

  $relationship = [
    'parent' => 'Parent',
    'sibling' => 'Sibling',
    'relative' => 'Relative',
    'friend' => 'Friend',
    'acquaintance' => 'Acquaintance',
    'other' => 'Other'
  ];

  $age_bracket = [
    '0-25' => 'Under 25',
    '25-40' => '25 to 40',
    '40+' => '40 +',
  ];

  $nach_potential = [
    '200-500' => '&#8377;200-500',
    '500-1000' => '&#8377;500-1,000',
    '1000-5000' => '&#8377;1,000-5,000',
    '5000+' => 'More than &#8377;5,000 '
  ];

  $otd_potential = [
    '500-1000' => '&#8377;500-1,000',
    '1000-5000' => '&#8377;1,000-5,000',
    '5000-10000' => '&#8377;5,000-10000',
    '10000-50000' => '&#8377;10,000-50,000 ',
    '50000-100000' => '&#8377;50,000-1 Lakh ',
    '100000+' => 'More than &#8377;1 Lakh '
  ];

  $collection = [
    'self' => 'By Myself',
    'handover_to_mad' => 'Handover collection to MAD',
  ];

  $user = $sql->getAll($query_user);
  $user = $user[0];

  $query_task_show = 'SELECT *
                      FROM FAM_UserTask
                      WHERE user_id='.$user_id;

  $tasks = $sql->getAssoc($query_task_show);


  // ---------------------- Functions -------------------------

  function create_select($array,$name, $req = false){

    if($req)
      $output = '<select name='.$name.' id="select" required>';
    else
      $output = '<select name='.$name.' id="select">';

    foreach ($array as $key => $value) {
      $output .= '<option value='.$key.'>';
      $output .= $value;
      $output .= '</option>';
    }
    $output .= '</select>';

    return $output;
  }

  function create_radio($array,$name, $req = false){

    $output = '<p class="form-label">';
    foreach ($array as $key => $value) {
      $output .= '<input class="radio-button-left" type="radio" id="'.$name.$key.'" name='.$name.' value="'.$key.'"/>';
      $output .= '<label for="'.$name.$key.'">';
      $output .= $value;
      $output .= '</label>';
      $output .= '<br>';
    }
    $output .= '</p>';

    return $output;
  }
