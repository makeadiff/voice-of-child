



<?php

include ('db/config.php');

// dump($_POST);

$survey_form_check = false;
$preference_form_check = false;
$recommendation_form_check = false;
$referral_form_check = false;

//verify user details
$user_city_id  = $_POST['user_city_id'];
$user_id       = $_POST['user_id'];
$user_name     = $_POST['user_name'];
$user_email    = $_POST['user_email'];
$user_phone    = $_POST['user_phone'];
$user_sex      = $_POST['user_sex'];
$user_birthday = $_POST['user_birthday'];
$user_address  = $_POST['user_address'];
$cont_status   = $_POST['cont_status'];
//update user details in User table

$sql->update('User', array(
                    'name' => $user_name,
                    'email' => $user_email,
                    'phone' => $user_phone,
                    'sex' => $user_sex,
                    'address' => $user_address,
                  ),'id='.$user_id);

//role compatibility survey
$survey_question = array();


for($i=6;$i<=18;$i++){
  if(isset($_POST['survey_question_'.$i]))
    $survey_question[$i] = $_POST['survey_question_'.$i];
}

//role compatibility survey add/update in SS_UserAnswer table
if(!empty($survey_question)) {
  foreach ($survey_question as $id => $response) {
    if($response!=''){
      $query_survey_check = 'SELECT id FROM SS_UserAnswer WHERE user_id='.$user_id.' AND question_id='.$id;
      $check = $sql->getOne($query_survey_check);

      if($check==''){
        $insert = $sql->insert('SS_UserAnswer',array(
                          'question_id' => $id,
                          'user_id' => $user_id,
                          'answer' => $response,
                          'survey_event_id' => 7,
                          'comment' => '',
                          'added_on' => date('Y-m-d H:i:s')
                        ));
        if($insert!=0){
          $survey_form_check = true;
        }
      }
      else{
        $insert = $sql->update('SS_UserAnswer',array(
          'answer' => $response,
          'added_on' => date('Y-m-d H:i:s')
        ),'id='.$check);
      }
    }
  }
}

// var_dump($survey_form_check);

//SignUp user group preference

$user_group_preference    = array();
$user_group_preference[0] = $_POST['user_group_preference_name'];

for($i=1;$i<=3;$i++){
  $user_group_preference[$i] = $_POST['fellow_prefernece'.$i.'_name'];
}

//SignUp user group preference insert/update in FAM_UserGroupPreference


$cont_status_id = $sql->getOne('SELECT id FROM UserData WHERE name="continuation_status" AND user_id='.$user_id);
if($cont_status_id==''){
  $insert_continuation_status= $sql->insert('UserData',array(
    'user_id' => $user_id,
    'name' => 'continuation_status',
    'value' => $cont_status,
    'data' => date('Y-m-d H:i:s')
  ));
}
else{
  $update_continuation_status = $sql->update('UserData',array(
    'value' => $cont_status
  ),'id='.$cont_status_id);
}


$query_user_group_preference_check="SELECT id FROM FAM_UserGroupPreference WHERE user_id=".$user_id;

$check_data = $sql->getAll($query_user_group_preference_check);
$check = array();
foreach ($check_data as $data) {
  $check[] = $data['id'];
}

if(!empty($check)){
  $delete = $sql->remove('FAM_UserGroupPreference','id IN ('.implode(',',$check).')');
}

if($user_group_preference[0]!=0){
  $insert_pref = $sql->insert('FAM_UserGroupPreference',array(
                            'user_id' => $user_id,
                            'group_id' => $user_group_preference[0],
                            'preference' => 1,
                            'taskfolder_link' => ''
                        ));

  if($insert_pref!=0){
    $preference_form_check = true;
  }
}
else{
  $insert_array = array();
  for ($i=1; $i<=3; $i++) {
    if($user_group_preference[$i]!=''){
      $insert_pref = $sql->insert('FAM_UserGroupPreference',array(
                                'user_id' => $user_id,
                                'group_id' => $user_group_preference[$i],
                                'preference' => $i,
                                'taskfolder_link' => ''
                            ));
      if($insert_pref!=0){
        $preference_form_check = true;
      }
    }
  }
}


// var_dump($preference_form_check);




//recommendation insert in FAM_Referral table

$recommendations = array();

for($i=1; $i<=3; $i++){
  $id = array();
  preg_match("|\d+|",$_POST['recommendation'.$i.'_name'],$id);

  if(empty($id)) continue;

  $recommendations[$i-1] = array(
    'referer_user_id' => $user_id,
    'referee_user_id' => $id[0],
    'group_id' => $_POST['recommendation'.$i.'_role_name'],
    'created_at' => date("Y-m-d H:i:s")
  );
}

foreach ($recommendations as $recommendation) {
  $insert_rec = $sql->insert('FAM_Referral',$recommendation);
  if($insert_rec!=0){
    $recommendation_form_check = true;
  }
}


// var_dump($recommendation_form_check);


//referral
// $referrals    = array();
//
// for ($i=1;$i<=3;$i++) {
//   if
//   $referrals[$i] = array(
//     'name'  => $_POST['referral'.$i.'_name'],
//     'email' => $_POST['referral'.$i.'_email'],
//     'phone' => $_POST['referral'.$i.'_phone'],
//     'sex' => $_POST['referral'.$i.'_sex']
//   );
// }
//
// foreach ($referrals as $referral) {
//   if($referral['name']!=''){
//     $check = $sql->getOne('SELECT id from User where (email="'.$referral['email'].'" OR mad_email="'.$referral['email'].'" OR phone="'.$referral['phone'].'")');
//     if($check==''){
//       $insert = $sql->insert('User',array(
//         'name' => $referral['name'],
//         'email' => $referral['email'],
//         'phone' => $referral['phone'],
//         'joined_on' => date('Y-m-d H:i:s'),
//         'sex' => $referral['sex'],
//         'city_id' => $user_city_id,
//         'password' => '',
//         'password_hash' => '',
//         'photo' => '',
//         'bio' => '',
//         'address' => '',
//         'profile_progress' => 0,
//         'source' => 'other',
//         'facebook_id' => '',
//         'source_other' => 'referral',
//         'birthday' => '1970-01-01 00:00:00',
//         'job_status' => 'student',
//         'left_on' => '1970-01-01 00:00:00',
//         'verification_status' => '',
//         'edu_institution' => '',
//         'company' => '',
//         'why_mad' => '',
//         'title' => '',
//         'reason_for_leaving' => '',
//         'center_id' => 0,
//         'city_other' => '',
//         'subject_id' => 0,
//         'project_id' => 0,
//         'consecutive_credit' => 0,
//         'admin_credit' => 0,
//         'app_version' => '',
//       ));
//
//       if($insert_ref!=0){
//         $referral_form_check = true;
//       }
//     }
//     else{
//       $referral_form_check = true;
//     }
//   }
// }

// var_dump($referral_form_check);

?>

<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Retention and Succession Form||Preview</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="5;URL='http://makeadiff.in/madapp'" />

        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

        <link rel="stylesheet" href="css/style.css">

        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">


    </head>

    <body>
      <div class="container">
          <h1 class="span12 fs-main-title text-center">Retention and Succession Form</h1>
      </div>
      <!-- MultiStep Form -->
      <div class="row">
          <div class="col-md-6 col-md-offset-3">
              <form id="msform" action="preview.php" method="POST" novalidate>
                <fieldset>
                    <h2 class="fs-title">Response Recorded</h2><hr>
                    <h3 class="fs-subtitle">Thank You</h3><hr>
                  </fieldset>
              </form>
          </div>
        </div>
      </body>
